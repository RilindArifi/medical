import {ref, watch} from "vue";
import {forEach, get, has, isArray, isFunction, isUndefined, merge, set} from "lodash";
import {CollectFlag, useVuelidate} from "@vuelidate/core";
import {onBeforeRouteLeave} from "vue-router";

export default function useForm(options = {}) {
    const initialState = ref(typeof options.initialState == 'function' ? options.initialState() : options.initialState);

    if (typeof options.rules != 'undefined') {
        for (let key in initialState.value) {
            if (!has(options.rules, key)) {
                options.rules[key] = {true: () => true};
            }
        }
    }

    const
        isLoading = ref(false),
        errors = ref(options.errors ?? {}),
        state = ref(options.state ?? initialState.value),
        rules = ref(options.rules),
        v$ = useVuelidate(rules, state, {$lazy: true, $externalResults: errors, $scope: CollectFlag.COLLECT_NONE}),
        updateState = newModel => {
            if (isFunction(options.onLoadModel)) {
                state.value = merge({...initialState.value}, options.onLoadModel(newModel));
            }
        },
        fieldError = (field) => {
            if (isArray(field)) {
                const errField = field.find(item => fieldError(item));

                return get(v$.value, `${errField}.$errors[0].$message`)
            }

            return get(v$.value, `${field}.$errors[0].$message`)
        },
        prepareRequest = callback => {
            isLoading.value = true;
            callback()
                .then(() => {
                    v$.value.$reset();

                })
                .catch(({response}) => {
                    errors.value = {}
                    if (response?.status === 422) {
                        forEach(response.data.errors, (item, index) => {
                            set(errors.value, index, item)
                        })
                    }
                })
                .finally(() => {
                    isLoading.value = false;
                })
        };

    if ((options.loadModel ?? true) && !isUndefined(options.model)) {
        updateState(options.model.value);

        watch(options.model, updateState)
    }

    if (!!options.useFormChanges) {
        onBeforeRouteLeave((to, from, next) => {
            next();
        })
    }

    return {
        model: options.model,
        initialState: options.initialState,
        isLoading,
        v$,
        errors,
        state,
        rules,
        fieldError,
        prepareRequest
    };
}
