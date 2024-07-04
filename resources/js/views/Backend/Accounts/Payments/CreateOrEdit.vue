<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb :title="title" :text="text" path="payments" />
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-heading">
                                            <h4>Add Payments</h4>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-forms">
                                            <label
                                                >Payment Number
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div
                                            class="input-block local-forms cal-icon"
                                        >
                                            <label
                                                >Payment Date
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
                                                >Patient Name
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-forms">
                                            <label
                                                >Doctor Name
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <vue-select
                                                :options="Doctors"
                                                id="doctors"
                                                placeholder="Enter Doctor Name"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-forms">
                                            <label
                                                >Total Amount
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-forms">
                                            <label
                                                >Discount
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="input-block local-forms">
                                            <label
                                                >Payment Method
                                                <span class="login-danger"
                                                    >*</span
                                                ></label
                                            >
                                            <vue-select
                                                :options="Pay"
                                                id="pay"
                                                placeholder="Select Payment Method"
                                            />
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
                                                :options="Unpaid"
                                                id="unpaid"
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
                                                Submit
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
            text: "Add Payments",
            startdate: currentDate,
            dateFormat: "dd-MM-yyyy",
            Doctors: [
                "Enter Doctor Name",
                "Dr.Galaviz Lalema",
                "Dr.Bernardo James",
                "Dr.Mark Hay Smith",
            ],
            Pay: [
                "Select Payment Method",
                "Credit Card",
                "Debit Card",
                "Pay Pal",
            ],
            Unpaid: [
                "Select Payment Status",
                "Paid",
                "Patially Paid",
                "Un Paid",
            ],
        };
    },
};
</script>
