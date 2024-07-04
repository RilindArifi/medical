<script setup>
import { dateFormat } from "@/utils/strings.js";
import RadioGender from "@/components/RadioGender.vue";
import DepartmentSelect from "@/components/departments/DepartmentSelect.vue";
import { useRoute } from "vue-router";

const props = defineProps({
        state: Object,
        fieldError: Function,
    }),
    route = useRoute(),
    required =
        !route.path.includes("patients") &&
        !route.path.includes("appointments"),
    staffs = !route.path.includes("staffs"),
    getError = (key) => {
        return props.fieldError(key);
    };
</script>

<template>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="input-block local-forms">
            <label>First Name <span class="login-danger">*</span></label>
            <input
                v-model="state.first_name"
                class="form-control"
                type="text"
                :class="{ 'is-invalid': getError('first_name') }"
            />
            <div class="invalid-feedback">{{ getError("first_name") }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="input-block local-forms">
            <label>Last Name <span class="login-danger">*</span></label>
            <input
                v-model="state.last_name"
                class="form-control"
                type="text"
                :class="{ 'is-invalid': getError('last_name') }"
            />
            <div class="invalid-feedback">{{ getError("last_name") }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="input-block local-forms">
            <label>Mobile <span class="login-danger">*</span></label>
            <input
                v-model="state.mobile"
                class="form-control"
                type="tel"
                :class="{ 'is-invalid': getError('mobile') }"
            />
            <div class="invalid-feedback">{{ getError("mobile") }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="input-block local-forms">
            <label>Email <span class="login-danger">*</span></label>
            <input
                v-model="state.email"
                class="form-control"
                type="email"
                :class="{ 'is-invalid': getError('email') }"
            />
            <div class="invalid-feedback">{{ getError("email") }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="input-block local-forms">
            <label>Password <span class="login-danger">*</span></label>
            <input
                v-model="state.password"
                class="form-control"
                type="password"
                :class="{ 'is-invalid': getError('password') }"
            />
            <div class="invalid-feedback">{{ getError("password") }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="input-block local-forms">
            <label>Confirm Password <span class="login-danger">*</span></label>
            <input
                v-model="state.password_confirmation"
                class="form-control"
                type="password"
                :class="{ 'is-invalid': getError('password_confirmation') }"
            />
            <div class="invalid-feedback">
                {{ getError("password_confirmation") }}
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="input-block local-forms cal-icon">
            <label
                >Date Of Birth
                <span v-if="required" class="login-danger">*</span></label
            >
            <a-date-picker
                v-model:value="state.dob"
                value-format="YYYY-MM-DD"
                :format="dateFormat()"
                class="form-control datetimepicker"
                placeholder=""
                :class="{ 'is-invalid': getError('dob') }"
                :suffix-icon="false"
            />
            <div class="invalid-feedback">{{ getError("dob") }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="input-block select-gender">
            <label class="gen-label"
                >Gender<span v-if="required" class="login-danger">
                    *</span
                ></label
            >
            <radio-gender
                v-model:value="state.gender"
                :class="{ 'is-invalid': getError('gender') }"
            />
            <div class="invalid-feedback">{{ getError("gender") }}</div>
        </div>
    </div>
    <template v-if="required">
        <div class="col-12 col-md-6 col-xl-6">
            <div class="input-block local-forms">
                <label>Education <span class="login-danger">*</span></label>
                <input
                    v-model="state.education"
                    class="form-control"
                    type="text"
                    :class="{ 'is-invalid': fieldError('education') }"
                />
                <div class="invalid-feedback">
                    {{ fieldError("education") }}
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-6">
            <div class="input-block local-forms">
                <label
                    >Department
                    <span v-if="required && staffs" class="login-danger"
                        >*</span
                    ></label
                >
                <department-select
                    v-model:value="state.department_id"
                    :class="{ 'is-invalid': fieldError('department_id') }"
                />
                <div class="invalid-feedback">
                    {{ fieldError("department_id") }}
                </div>
            </div>
        </div>
    </template>
</template>

<style scoped></style>
