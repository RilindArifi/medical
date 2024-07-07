<script setup>
import { onBeforeMount, ref, watch } from "vue";
import useForm from "@/composables/form.js";
import { required } from "@vuelidate/validators";
import { ACTIVE } from "@/enums/status-global.js";
import { useRoute, useRouter } from "vue-router";
import useModelOperations from "@/composables/model-operations.js";
import { message } from "ant-design-vue";
import RButton from "@/components/RButton.vue";
import GeneralForm from "@/components/form/General.vue";
import Addresses from "@/components/form/Addresses.vue";
import RolePermissions from "@/views/Backend/Staff/RolePermissions.vue";
import {dateFormat} from "@/utils/strings.js";
import StaffSelect from "@/components/staff/StaffSelect.vue";
import PaymentsMethod from "@/components/pay/PaymentsMethod.vue";
import LeaveStatusSelect from "@/components/leaves/LeaveStatusSelect.vue";

const model = ref({}),
    models = useModelOperations("expenses"),
    route = useRoute(),
    router = useRouter(),
    modelId = ref(route.params.id),
    { isLoading, state, fieldError, prepareRequest, rules, v$, errors } =
        useForm({
            loadModel: !!modelId,
            useFormChanges: true,
            model: model,
            onLoadModel: (model) => ({
                user_id: model["user_id"],
                item_name: model["item_name"],
                purchase_from: model["purchase_from"],
                purchase_date: model["purchase_date"],
                amount: model["amount"],
                information: model["information"],
                paid_by: model["paid_by"],
                status: model["status"],
            }),
            initialState: {
                user_id: null,
                item_name: null,
                purchase_from: null,
                purchase_date: null,
                amount: null,
                paid_by: null,
                status: null,
                information: null,
            },
            rules: {
                user_id: { required },
                item_name: { required },
                purchase_from: { required },
                purchase_date: { required },
                amount: { required },
                paid_by: { required },
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
                    `Expense was successfully ${modelId.value ? "updated" : "created"}.`,
                );
                router.push({
                    name: "expenses.edit",
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
            <!-- Page Header -->
            <breadcrumb title="Expenses" text="New Expense" path="/accounts/expenses" />
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
                                                <h4>{{
                                                        modelId
                                                            ? "Update Expense"
                                                            : "Add Expense"
                                                    }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="input-block local-forms">
                                                <label >Item Name <span class="login-danger" >*</span></label>
                                                <input
                                                    v-model="state.item_name"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder=""
                                                    :class="{'is-invalid': fieldError('item_name')}"
                                                />
                                                <div class="invalid-feedback">{{ fieldError("item_name") }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="input-block local-forms">
                                                <label
                                                    >Purchase From
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    v-model="state.purchase_from"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder=""
                                                    :class="{'is-invalid': fieldError('purchase_from')}"
                                                />
                                                <div class="invalid-feedback">{{ fieldError("purchase_from") }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div
                                                class="input-block local-forms cal-icon"
                                            >
                                                <label
                                                    >Purchase Date
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <a-date-picker
                                                    v-model:value="state.purchase_date"
                                                    value-format="YYYY-MM-DD"
                                                    :format="dateFormat()"
                                                    class="form-control datetimepicker"
                                                    placeholder=""
                                                    :class="{'is-invalid': fieldError('purchase_date')}"
                                                />
                                                <div class="invalid-feedback">{{ fieldError("purchase_date") }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="input-block local-forms">
                                                <label
                                                    >Purchased by
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <staff-select
                                                    v-model:value="state.user_id"
                                                    :class="{'is-invalid': fieldError('user_id')}"
                                                />
                                                <div class="invalid-feedback">{{ fieldError("user_id") }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="input-block local-forms">
                                                <label
                                                    >Amount
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    v-model="state.amount"
                                                    class="form-control"
                                                    type="text"
                                                    :class="{'is-invalid': fieldError('amount')}"
                                                />
                                                <div class="invalid-feedback">{{ fieldError("amount") }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="input-block local-forms">
                                                <label
                                                    >Paid By
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <payments-method
                                                    v-model:value="state.paid_by"
                                                    :class="{'is-invalid': fieldError('paid_by')}"
                                                />
                                                <div class="invalid-feedback">{{ fieldError("paid_by") }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="input-block local-top-form">
                                                <label class="local-top"
                                                    >Avatar
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
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
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="input-block local-forms">
                                                <label
                                                    >Payment Status
                                                    <span class="login-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <leave-status-select
                                                    v-model:value="state.status"
                                                    :class="{'is-invalid': fieldError('status')}"
                                                />
                                                <div class="invalid-feedback">{{ fieldError("status") }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="input-block local-forms">
                                                <label
                                                    >Other Information</label>
                                                <textarea
                                                    v-model="state.information"
                                                    class="form-control"
                                                    rows="3"
                                                    cols="30"
                                                ></textarea>
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
                                                    :to="{name: 'expenses.index'}"
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
