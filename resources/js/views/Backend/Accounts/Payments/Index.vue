<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb :title="title" :text="text" path="payments" />
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table show-entire">
                        <div class="card-body">
                            <!-- Table Header -->
                            <div class="page-table-header mb-2">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="doctor-table-blk">
                                            <h3>Payment List</h3>
                                            <div class="doctor-search-blk">
                                                <div
                                                    class="top-nav-search table-search-blk"
                                                >
                                                    <form>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Search here"
                                                        />
                                                        <a class="btn"
                                                            ><img
                                                                src="../../../../assets/img/icons/search-normal.svg"
                                                                alt=""
                                                        /></a>
                                                    </form>
                                                </div>
                                                <div class="add-group">
                                                    <router-link
                                                        to="add-payment"
                                                        class="btn btn-primary add-pluss ms-2"
                                                        ><img
                                                            src="../../../../assets/img/icons/plus.svg"
                                                            alt=""
                                                    /></router-link>
                                                    <a
                                                        href="javascript:;"
                                                        class="btn btn-primary doctor-refresh ms-2"
                                                        ><img
                                                            src="../../../../assets/img/icons/re-fresh.svg"
                                                            alt=""
                                                    /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-auto text-end float-end ms-auto download-grp"
                                    >
                                        <a href="javascript:;" class="me-2"
                                            ><img
                                                src="../../../../assets/img/icons/pdf-icon-01.svg"
                                                alt=""
                                        /></a>
                                        <a href="javascript:;" class="me-2"
                                            ><img
                                                src="../../../../assets/img/icons/pdf-icon-02.svg"
                                                alt=""
                                        /></a>
                                        <a href="javascript:;" class="me-2"
                                            ><img
                                                src="../../../../assets/img/icons/pdf-icon-03.svg"
                                                alt=""
                                        /></a>
                                        <a href="javascript:;"
                                            ><img
                                                src="../../../../assets/img/icons/pdf-icon-04.svg"
                                                alt=""
                                        /></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Table Header -->
                            <div class="staff-search-table">
                                <form>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div
                                                class="input-block local-forms cal-icon"
                                            >
                                                <label>From </label>
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
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div
                                                class="input-block local-forms cal-icon"
                                            >
                                                <label>To </label>
                                                <datepicker
                                                    v-model="startdateOne"
                                                    :input-format="dateFormat"
                                                    class="form-control datetimepicker"
                                                    :editable="true"
                                                    :clearable="false"
                                                    placeholder=""
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label>Payment Status </label>
                                                <vue-select
                                                    :options="Patially"
                                                    id="patially"
                                                    placeholder="Select Payment Status"
                                                />
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-6 col-xl-4 ms-auto"
                                        >
                                            <div class="doctor-submit">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary submit-list-form me-2"
                                                >
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <a-table
                                    class="table border-0 custom-table comman-table datatable mb-0"
                                    :columns="columns"
                                    :data-source="data"
                                    :row-selection="{}"
                                >
                                    <template #bodyCell="{ column, record }">
                                        <template
                                            v-if="
                                                column.key === 'InvoiceNumber'
                                            "
                                        >
                                            <div>
                                                <router-link
                                                    to="invoice-view"
                                                    >{{
                                                        record.InvoiceNumber
                                                    }}</router-link
                                                >
                                            </div>
                                        </template>
                                        <template
                                            v-else-if="column.key === 'Patient'"
                                        >
                                            <div class="profile-image">
                                                <router-link to="/profile"
                                                    ><img
                                                        width="28"
                                                        height="28"
                                                        :src="`/src/assets/img/profiles/${record.Avatar}`"
                                                        class="rounded-circle m-r-5"
                                                        alt=""
                                                    />
                                                    {{
                                                        record.Patient
                                                    }}</router-link
                                                >
                                            </div>
                                        </template>
                                        <template
                                            v-else-if="column.key === 'Status'"
                                        >
                                            <div>
                                                <button :class="record.Class">
                                                    {{ record.Status }}
                                                </button>
                                            </div>
                                        </template>
                                        <template
                                            v-else-if="column.key === 'action'"
                                        >
                                            <div class="text-end">
                                                <div
                                                    class="dropdown dropdown-action"
                                                >
                                                    <a
                                                        href="javascript:;"
                                                        class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                        ><i
                                                            class="fa fa-ellipsis-v"
                                                        ></i
                                                    ></a>
                                                    <div
                                                        class="dropdown-menu dropdown-menu-end"
                                                    >
                                                        <router-link
                                                            class="dropdown-item"
                                                            to="edit-payment"
                                                            ><i
                                                                class="fa-solid fa-pen-to-square m-r-5"
                                                            ></i>
                                                            Edit</router-link
                                                        >
                                                        <a
                                                            class="dropdown-item"
                                                            href="javascript:;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete_patient"
                                                            ><i
                                                                class="fa fa-trash-alt m-r-5"
                                                            ></i>
                                                            Delete</a
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </template>
                                </a-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <delete></delete>
</template>

<script>
const columns = [
    {
        title: "Invoices Number",
        dataIndex: "InvoiceNumber",
        key: "InvoiceNumber",
        sorter: {
            compare: (a, b) => {
                a = a.InvoiceNumber.toLowerCase();
                b = b.InvoiceNumber.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Patient",
        dataIndex: "Patient",
        key: "Patient",
        sorter: {
            compare: (a, b) => {
                a = a.Patient.toLowerCase();
                b = b.Patient.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Payment Type",
        dataIndex: "PaymentType",
        sorter: {
            compare: (a, b) => {
                a = a.PaymentType.toLowerCase();
                b = b.PaymentType.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Paid Date",
        dataIndex: "PaidDate",
        sorter: {
            compare: (a, b) => {
                a = a.PaidDate.toLowerCase();
                b = b.PaidDate.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Paid Amount",
        dataIndex: "PaidAmount",
        sorter: {
            compare: (a, b) => {
                a = a.PaidAmount.toLowerCase();
                b = b.PaidAmount.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Status",
        dataIndex: "Status",
        key: "Status",
        sorter: {
            compare: (a, b) => {
                a = a.Status.toLowerCase();
                b = b.Status.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "",
        key: "action",
        sorter: true,
        class: "text-end",
    },
];

const data = [
    {
        id: "1",
        Avatar: "avatar-01.jpg",
        InvoiceNumber: "#INV-0004",
        Patient: "Andrea Lalema",
        PaymentType: "Credit Card",
        PaidDate: "01.10.2022",
        PaidAmount: "$2450",
        Status: "Paid",
        Class: "custom-badge status-green",
    },
    {
        id: "2",
        Avatar: "avatar-02.jpg",
        InvoiceNumber: "#INV-0001",
        Patient: "Smith Bruklin",
        PaymentType: "Debit Card",
        PaidDate: "02.10.2022",
        PaidAmount: "$1505",
        Status: "Un Paid",
        Class: "custom-badge status-pink",
    },
    {
        id: "3",
        Avatar: "avatar-03.jpg",
        InvoiceNumber: "#INV-0002",
        Patient: "Bernardo James",
        PaymentType: "Pay Pal",
        PaidDate: "01.10.2022",
        PaidAmount: "$2000",
        Status: "Paid",
        Class: "custom-badge status-pink",
    },
    {
        id: "4",
        Avatar: "avatar-04.jpg",
        InvoiceNumber: "#INV-0003",
        Patient: "Mark Hay Smith",
        PaymentType: "Credit Card",
        PaidDate: "05.10.2022",
        PaidAmount: "$1000",
        Status: "Patially Paid",
        Class: "custom-badge status-orange",
    },
    {
        id: "5",
        Avatar: "avatar-05.jpg",
        InvoiceNumber: "#INV-0004",
        Patient: "Galaviz Lalema",
        PaymentType: "Debit Card",
        PaidDate: "01.10.2022",
        PaidAmount: "$2300",
        Status: "Paid",
        Class: "custom-badge status-green",
    },
    {
        id: "6",
        Avatar: "avatar-06.jpg",
        InvoiceNumber: "#INV-0003",
        Patient: "Andrea Lalema",
        PaymentType: "Pay Pal",
        PaidDate: "05.10.2022",
        PaidAmount: "$4000",
        Status: "Patially Paid",
        Class: "custom-badge status-orange",
    },
    {
        id: "7",
        Avatar: "avatar-07.jpg",
        InvoiceNumber: "#INV-0005",
        Patient: "William Stephin",
        PaymentType: "Pay Pal",
        PaidDate: "10.10.2022",
        PaidAmount: "$3000",
        Status: "Un Paid",
        Class: "custom-badge status-pink",
    },
];

import { ref } from "vue";
const currentDate = ref(new Date());
const currentDateOne = ref(new Date());
export default {
    data() {
        return {
            title: "Accounts",
            text: "Payments",
            startdate: currentDate,
            startdateOne: currentDateOne,
            dateFormat: "dd-MM-yyyy",
            columns,
            data,
            Patially: [
                "Select Payment Status",
                "Paid",
                "Un Paid",
                "Patially Paid",
            ],
        };
    },
};
</script>
