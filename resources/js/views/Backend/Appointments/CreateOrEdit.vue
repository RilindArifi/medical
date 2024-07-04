<script setup>
import { ref } from "vue";
import useForm from "@/composables/form.js";
import { required } from "@vuelidate/validators";
import PatientSelect from "@/components/patients/PatientSelect.vue";
import General from "@/components/form/General.vue";
import DoctorSelect from "@/components/doctors/DoctorSelect.vue";
import { message } from "ant-design-vue";
import useModelOperations from "@/composables/model-operations.js";
import { useRoute, useRouter } from "vue-router";
import { dateFormat } from "@/utils/strings.js";
import { PENDING } from "@/enums/status-appointments.js";

const model = ref({}),
    models = useModelOperations("appointments"),
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
            first_name: model["first_name"],
            last_name: model["last_name"],
            mobile: model["mobile"],
            email: model["email"],
            password: model["password"],
            password_confirmation: model["password_confirmation"],
            dob: model["dob"],
            gender: model["gender"],

            doctor_id: model["doctor_id"],
            patient_id: model["patient_id"],
            date: model["date"],
            from: model["from"],
            to: model["to"],
            treatment: model["treatment"],
            notes: model["notes"],
            image: model["image"],
        }),
        initialState: {
            first_name: null,
            last_name: null,
            mobile: null,
            email: null,
            password: null,
            password_confirmation: null,
            dob: null,
            status: modelId ? "" : PENDING,
            gender: null,

            doctor_id: null,
            patient_id: null,
            date: null,
            from: null,
            to: null,
            treatment: null,
            notes: null,
            image: null,
        },
        rules: {
            date: { required },
            from: { required },
            to: { required },
            treatment: { required },
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
                    `Appointment was successfully ${modelId ? "updated" : "created"}.`,
                );
                router.push({
                    name: "appointments.edit",
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
                :title="$t('appointments.appointmentList')"
                text="Book Appointment"
                path="/appointments"
            />
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form @submit.prevent="onSubmit">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="col-12">
                                                    <div class="form-heading">
                                                        <h4>Choose Patient</h4>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-md-6 col-xl-12"
                                                >
                                                    <div
                                                        class="input-block local-forms"
                                                    >
                                                        <label
                                                            >Patient name<span
                                                                class="login-danger"
                                                                >*</span
                                                            ></label
                                                        >
                                                        <patient-select
                                                            v-model:value="
                                                                state.patient_id
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-8"
                                                v-if="!state.patient_id"
                                            >
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div
                                                            class="form-heading"
                                                        >
                                                            <h4>New Patient</h4>
                                                        </div>
                                                    </div>
                                                    <general
                                                        :state="state"
                                                        :field-error="
                                                            fieldError
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-heading">
                                            <h4>Appointment Details</h4>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div
                                            class="input-block local-forms cal-icon"
                                        >
                                            <label
                                                >Date of Appointment
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <a-date-picker
                                                v-model:value="state.date"
                                                placeholder="Select Date"
                                                class="form-control datetimepicker"
                                                :suffix-icon="false"
                                                value-format="YYYY-MM-DD"
                                                :format="dateFormat()"
                                                :class="{
                                                    'is-invalid':
                                                        fieldError('date'),
                                                }"
                                            />
                                            <div class="invalid-feedback">
                                                {{ fieldError("date") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="input-block local-forms">
                                            <label
                                                >From
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <div class="time-icon">
                                                <a-time-picker
                                                    v-model:value="state.from"
                                                    id="datetimepicker3"
                                                    class="form-control"
                                                    placeholder="09:00 AM"
                                                    use12-hours
                                                    format="H:mm"
                                                    value-format="H:mm"
                                                    type="text"
                                                    :class="{
                                                        'is-invalid':
                                                            fieldError('from'),
                                                    }"
                                                />
                                                <div class="invalid-feedback">
                                                    {{ fieldError("from") }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="input-block local-forms">
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
                                                    placeholder="09:00 AM"
                                                    use12-hours
                                                    format="H:mm"
                                                    value-format="H:mm"
                                                    type="text"
                                                    :class="{
                                                        'is-invalid':
                                                            fieldError('to'),
                                                    }"
                                                />
                                                <div class="invalid-feedback">
                                                    {{ fieldError("to") }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-forms">
                                            <label>Consulting Doctor</label>
                                            <doctor-select
                                                v-model:value="state.doctor_id"
                                                :class="{
                                                    'is-invalid':
                                                        fieldError('doctor_id'),
                                                }"
                                            />
                                            <div class="invalid-feedback">
                                                {{ fieldError("doctor_id") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-forms">
                                            <label
                                                >Treatment
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                v-model="state.treatment"
                                                class="form-control"
                                                type="text"
                                                placeholder=""
                                                :class="{
                                                    'is-invalid':
                                                        fieldError('treatment'),
                                                }"
                                            />
                                            <div class="invalid-feedback">
                                                {{ fieldError("treatment") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="input-block local-forms">
                                            <label>Notes </label>
                                            <textarea
                                                v-model="state.notes"
                                                class="form-control"
                                                rows="3"
                                                cols="30"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-top-form">
                                            <label class="local-top"
                                                >Avatar</label
                                            >
                                            <div
                                                class="settings-btn upload-files-avator"
                                            >
                                                <input
                                                    type="file"
                                                    accept="image/*"
                                                    name="image"
                                                    id="file"
                                                    onchange="loadFile(event)"
                                                    class="hide-input"
                                                />
                                                <label for="file" class="upload"
                                                    >Choose File</label
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="doctor-submit text-end">
                                            <button
                                                type="submit"
                                                class="btn btn-primary submit-form me-2"
                                            >
                                                Submit
                                            </button>
                                            <router-link
                                                :to="{
                                                    name: 'appointments.index',
                                                }"
                                                class="btn btn-primary cancel-form"
                                                >Cancel</router-link
                                            >
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
