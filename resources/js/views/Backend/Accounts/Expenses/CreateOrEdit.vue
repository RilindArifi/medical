<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb :title="title" :text="text" path="expenses" />
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-heading">
                                            <h4>Add Expenses</h4>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-forms">
                                            <label
                                                >Item Name
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                                placeholder=""
                                            />
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
                                                class="form-control"
                                                type="text"
                                                placeholder=""
                                            />
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
                                            <datepicker
                                                v-model="startdate"
                                                :input-format="dateFormat"
                                                class="form-control datetimepicker"
                                                :editable="true"
                                                :clearable="false"
                                                placeholder=""
                                            />
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
                                            <vue-select
                                                :options="Bernardo"
                                                id="bernardo"
                                                placeholder="Select Purchase by"
                                            />
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
                                                class="form-control"
                                                type="text"
                                                placeholder=""
                                            />
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
                                            <vue-select
                                                :options="Cheque"
                                                id="cheque"
                                                placeholder="Select Paid by"
                                            />
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
                                            <vue-select
                                                :options="Approved"
                                                id="approved"
                                                placeholder="Select Payment Status"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="input-block local-forms">
                                            <label
                                                >Other Information
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <textarea
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
                                                Create Expense
                                            </button>
                                            <button
                                                type="submit"
                                                class="btn btn-primary cancel-form"
                                            >
                                                Cancel
                                            </button>
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

<script>
import { ref } from "vue";
const currentDate = ref(new Date());
export default {
    data() {
        return {
            title: "Accounts",
            text: "Add Expenses",
            startdate: currentDate,
            dateFormat: "dd-MM-yyyy",
            Bernardo: [
                "Select Purchase by",
                "Bernardo James",
                "Galaviz Lalema",
                "Tarah Williams",
            ],
            Cheque: ["Select Paid by", "Paypal", "Cheque", "Debit Card"],
            Approved: [
                "Select Payment Status",
                "Approved",
                "Rejected",
                "Pending",
            ],
        };
    },
};
</script>
