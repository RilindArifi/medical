<script setup>
import { dateFormat } from "@/utils/strings.js";
import DoctorSelect from "@/components/doctors/DoctorSelect.vue";
import RadioStatus from "@/components/RadioStatus.vue";
import RButton from "@/components/RButton.vue";
import { ref } from "vue";
import useModelOperations from "@/composables/model-operations.js";
import { useRoute, useRouter } from "vue-router";
import useForm from "@/composables/form.js";
import { ACTIVE } from "@/enums/status-global.js";
import { required } from "@vuelidate/validators";
import { message } from "ant-design-vue";
import { PENDING } from "@/enums/status-appointments.js";
import ScheduleSelect from "@/components/schedule/DaysSelect.vue";

const model = ref({}),
    models = useModelOperations("schedules"),
    route = useRoute(),
    router = useRouter(),
    modelId = route.params.id,
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
        loadModel: !!modelId,
        useFormChanges: true,
        model: model,
        onLoadModel: (model) => ({
            doctor_id: model["doctor_id"],
            available_days: model["available_days"],
            from: model["from"],
            to: model["to"],
            treatment: model["treatment"],
            notes: model["notes"],
            status: model["status"],
        }),
        initialState: {
            doctor_id: null,
            available_days: [],
            from: null,
            to: null,
            notes: null,
            status: modelId ? "" : ACTIVE,
        },
        rules: {
            doctor_id: { required },
            status: { required },
            available_days: { required },
            from: { required },
            to: { required },
        },
    }),
    onSubmit = async () => {
        errors.value = {};
        const result = await v$.value.$validate();

        if (!result) {
            return;
        }
        await prepareRequest(() =>
            (modelId
                ? models.updateAction(modelId, state.value)
                : models.storeAction(state.value)
            ).then((response) => {
                message.success(
                    `Schedule was successfully ${modelId ? "updated" : "created"}.`,
                );
                router.push({
                    name: "schedules.edit",
                    params: { id: response.data.data.id },
                });
            }),
        );
    };

if (modelId) {
    isLoading.value = true;
    models
        .fetchSingle(modelId)
        .then((response) => {
            model.value = response.data.data;
        })
        .finally(() => (isLoading.value = false));
}
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb
                title="Schedules"
                text="New Schedule"
                path="/schedules"
            />
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a-spin :spinning="isLoading">
                                <form @submit.prevent="onSubmit">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-heading">
                                                <h4>Add Schedule</h4>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label
                                                    >Doctor Name
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <doctor-select
                                                    v-model:value="
                                                        state.doctor_id
                                                    "
                                                    :class="{
                                                        'is-invalid':
                                                            fieldError(
                                                                'doctor_id',
                                                            ),
                                                    }"
                                                />
                                                <div class="invalid-feedback">
                                                    {{
                                                        fieldError("doctor_id")
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label
                                                    >Available Days
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <schedule-select
                                                    v-model:value="
                                                        state.available_days
                                                    "
                                                    :class="{
                                                        'is-invalid':
                                                            fieldError(
                                                                'available_days',
                                                            ),
                                                    }"
                                                />
                                                <div class="invalid-feedback">
                                                    {{
                                                        fieldError(
                                                            "available_days",
                                                        )
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label
                                                    >From
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <div class="time-icon">
                                                    <a-time-picker
                                                        v-model:value="
                                                            state.from
                                                        "
                                                        id="datetimepicker3"
                                                        class="form-control"
                                                        placeholder=""
                                                        use12-hours
                                                        format="H:mm"
                                                        value-format="H:mm"
                                                        type="text"
                                                        :class="{
                                                            'is-invalid':
                                                                fieldError(
                                                                    'from',
                                                                ),
                                                        }"
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ fieldError("from") }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label
                                                    >To
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <div class="time-icon">
                                                    <a-time-picker
                                                        v-model:value="state.to"
                                                        id="datetimepicker4"
                                                        class="form-control"
                                                        placeholder=""
                                                        use12-hours
                                                        format="H:mm"
                                                        value-format="H:mm"
                                                        type="text"
                                                        :class="{
                                                            'is-invalid':
                                                                fieldError(
                                                                    'to',
                                                                ),
                                                        }"
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ fieldError("to") }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label>Notes </label>
                                                <textarea
                                                    v-model="state.notes"
                                                    class="form-control"
                                                    rows="3"
                                                    cols="30"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div
                                                class="input-block select-gender"
                                            >
                                                <label class="gen-label"
                                                    >Status
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <radio-status
                                                    v-model:value="state.status"
                                                    :class="{
                                                        'is-invalid':
                                                            fieldError(
                                                                'status',
                                                            ),
                                                    }"
                                                />
                                                <div class="invalid-feedback">
                                                    {{ fieldError("status") }}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="doctor-submit text-end"
                                                >
                                                    <r-button
                                                        text="Submit"
                                                        :is-loading="isLoading"
                                                        class-b="btn btn-primary submit-form me-2"
                                                    />
                                                    <router-link
                                                        :to="{
                                                            name: 'schedules.index',
                                                        }"
                                                        type="submit"
                                                        class="btn btn-primary cancel-form"
                                                        >Cancel</router-link
                                                    >
                                                </div>
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
