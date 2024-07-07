<script setup>
import {ref, watch} from "vue";
import useForm from "@/composables/form.js";
import { email, required } from "@vuelidate/validators";
import { ACTIVE } from "@/enums/status-global.js";
import { useRoute, useRouter } from "vue-router";
import useModelOperations from "@/composables/model-operations.js";
import { message } from "ant-design-vue";
import RButton from "@/components/RButton.vue";
import GeneralForm from "@/components/form/General.vue";
import Addresses from "@/components/form/Addresses.vue";

const model = ref({}),
    models = useModelOperations("doctors"),
    route = useRoute(),
    router = useRouter(),
    modelId = ref(route.params.id),
    {
        isLoading,
        state,
        fieldError,
        prepareRequest,
        rules,
        v$,
        initialState,
        errors,
    } = useForm({
        loadModel: !!modelId.value,
        useFormChanges: true,
        model: model,
        onLoadModel: (model) => ({
            first_name: model["first_name"],
            last_name: model["last_name"],
            mobile: model["mobile"],
            email: model["email"],
            password: model["password"],
            password_confirmation: model["password_confirmation"],
            dob: model["dob"],
            gender: model["gender"],
            education: model["education"],
            department_id: model["department_id"],
            address: model["address"],
            country: model["country"],
            city: model["city"],
            postal_code: model["postal_code"],
            status: model["status"],
            avatar: model["avatar"],
        }),
        initialState: {
            first_name: null,
            last_name: null,
            mobile: null,
            email: null,
            password: null,
            password_confirmation: null,
            dob: null,
            gender: null,
            education: null,
            department_id: null,
            address: null,
            country: null,
            city: null,
            postal_code: null,
            status: ACTIVE,
            avatar: null,
        },
        rules: {
            first_name: { required },
            last_name: { required },
            mobile: { required },
            email: { required, email },
            dob: { required },
            gender: { required },
            education: { required },
            department_id: { required },
            address: { required },
            postal_code: { required },
            status: { required },
        },
    }),
    onSubmit = async () => {
        errors.value = {};
        const result = await v$.value.$validate();

        if (!result) {
            return;
        }
        await prepareRequest(() =>
            (modelId.value
                ? models.updateAction(modelId.value, state.value)
                : models.storeAction(state.value)
            ).then((response) => {
                message.success(
                    `Doctor was successfully ${modelId.value
                        ? "updated" : "created"}.`,
                );
                router.push({
                    name: "doctors.edit",
                    params: { id: response.data.data.id },
                });
            }),
        );
    },
    fetchModelData = (id) => {
        isLoading.value = true;
        models
            .fetchSingle(id)
            .then((response) => {
                model.value = response.data.data;
            })
            .finally(() => (isLoading.value = false));
    };

if (modelId.value) {
    fetchModelData(modelId.value);
}

watch(() => route.params.id, (newId) => {
    modelId.value = newId;
    if (newId) {
        fetchModelData(newId);
    }
});
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <breadcrumb
                title="Doctors"
                :text="modelId ? 'Update Doctor' : 'New Doctor'"
                path="/doctors"
            />
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a-spin :spinning="isLoading">
                                <form @submit.prevent="onSubmit">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-heading">
                                                <h4>
                                                    {{
                                                        modelId
                                                            ? "Update Doctor"
                                                            : "Add Doctor"
                                                    }}
                                                </h4>
                                            </div>
                                        </div>

                                        <general-form
                                            :state="state"
                                            :field-error="fieldError"
                                        />

                                        <addresses
                                            :state="state"
                                            :field-error="fieldError"
                                        />

                                        <div class="col-12">
                                            <div class="doctor-submit text-end">
                                                <RButton
                                                    class-b="btn btn-primary submit-form me-2"
                                                    text="Submit"
                                                />
                                                <router-link
                                                    :to="{
                                                        name: 'doctors.index',
                                                    }"
                                                    class="btn btn-primary cancel-form"
                                                >
                                                    Cancel
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </a-spin>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
