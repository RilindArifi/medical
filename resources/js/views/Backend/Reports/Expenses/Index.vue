<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb :title="title" :text="text" path="expense-reports" />
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
                                            <h3>Expense Report</h3>
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
                                                        to="/accounts/add-expense"
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
                            <reports-head></reports-head>

                            <div class="table-responsive">
                                <a-table
                                    class="table custom-table comman-table mb-0 datatable"
                                    :columns="columns"
                                    :data-source="data"
                                    :row-selection="{}"
                                >
                                    <template #bodyCell="{ column, record }">
                                        <template
                                            v-if="column.key === 'Purchaseby'"
                                        >
                                            <div class="profile-image">
                                                <router-link to="/profile"
                                                    ><img
                                                        width="28"
                                                        height="28"
                                                        :src="`/src/assets/img/profiles/${record.Image}`"
                                                        class="rounded-circle m-r-5"
                                                        alt=""
                                                    />
                                                    {{
                                                        record.Purchaseby
                                                    }}</router-link
                                                >
                                            </div>
                                        </template>
                                        <template
                                            v-else-if="column.key === 'Status'"
                                        >
                                            <div class="dropdown action-label">
                                                <a
                                                    :class="record.Class"
                                                    href="javascript:;"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                >
                                                    {{ record.Status }}
                                                </a>
                                                <div
                                                    class="dropdown-menu dropdown-menu-end status-staff"
                                                >
                                                    <a
                                                        class="dropdown-item"
                                                        href="javascript:;"
                                                        >New</a
                                                    >
                                                    <a
                                                        class="dropdown-item"
                                                        href="javascript:;"
                                                        >Pending</a
                                                    >
                                                    <a
                                                        class="dropdown-item"
                                                        href="javascript:;"
                                                        >Approved</a
                                                    >
                                                    <a
                                                        class="dropdown-item"
                                                        href="javascript:;"
                                                        >Rejected</a
                                                    >
                                                </div>
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
                                                            to="/accounts/edit-expense"
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
</template>
<script>
import Reports_Head from "@/views/Backend/Reports/reports-head.vue";

const columns = [
    {
        title: "Item",
        dataIndex: "Item",
        sorter: {
            compare: (a, b) => {
                a = a.Item.toLowerCase();
                b = b.Item.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Purchase From",
        dataIndex: "PurchaseFrom",
        key: "id",
        sorter: {
            compare: (a, b) => {
                a = a.PurchaseFrom.toLowerCase();
                b = b.PurchaseFrom.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Purchase by",
        dataIndex: "Purchaseby",
        key: "Purchaseby",
        sorter: {
            compare: (a, b) => {
                a = a.Purchaseby.toLowerCase();
                b = b.Purchaseby.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Paid by",
        dataIndex: "Paidby",
        sorter: {
            compare: (a, b) => {
                a = a.Paidby.toLowerCase();
                b = b.Paidby.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Date",
        dataIndex: "Date",
        sorter: {
            compare: (a, b) => {
                a = a.Date.toLowerCase();
                b = b.Date.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Amount",
        dataIndex: "Amount",
        sorter: {
            compare: (a, b) => {
                a = a.Amount.toLowerCase();
                b = b.Amount.toLowerCase();
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
        class: "text-end",
        sorter: true,
    },
];

const data = [
    {
        Image: "avatar-01.jpg",
        Item: "Anaesthetic machine",
        PurchaseFrom: "Biomedical Equipment Inc",
        Purchaseby: "Andrea Lalema",
        Paidby: "Paypal",
        Date: "04.10.2022",
        Amount: "$1000",
        Class: "custom-badge status-green dropdown-toggle",
        Status: "Approved",
    },
    {
        Image: "avatar-03.jpg",
        Item: "Aspiration Pump",
        PurchaseFrom: "Medi Pro Service",
        Purchaseby: "William Stephin",
        Paidby: "Cheque",
        Date: "08.10.2022",
        Amount: "$2000",
        Class: "custom-badge status-pink dropdown-toggle",
        Status: "Rejected",
    },
    {
        Image: "avatar-04.jpg",
        Item: "Anaesthetic machine",
        PurchaseFrom: "Biomedical Equipment Inc",
        Purchaseby: "Smith Bruklin",
        Paidby: "Paypal",
        Date: "04.10.2022",
        Amount: "$1000",
        Class: "custom-badge status-orange dropdown-toggle",
        Status: "Pending",
    },
    {
        Image: "avatar-04.jpg",
        Item: "Anaesthetic machine",
        PurchaseFrom: "Biomedical Equipment Inc",
        Purchaseby: "Bernardo James",
        Paidby: "Paypal",
        Date: "04.10.2022",
        Amount: "$1000",
        Class: "custom-badge status-purple dropdown-toggle",
        Status: "New",
    },
    {
        Image: "avatar-06.jpg",
        Item: "Medical Expenses",
        PurchaseFrom: "Hi-life Medicals",
        Purchaseby: "Cristina Groves",
        Paidby: "Debit Card",
        Date: "03.10.2022",
        Amount: "$1600",
        Class: "custom-badge status-green dropdown-toggle",
        Status: "Approved",
    },
    {
        Image: "avatar-05.jpg",
        Item: "Anaesthetic machine",
        PurchaseFrom: "Biomedical Equipment Inc",
        Purchaseby: "Mark Hay Smith",
        Paidby: "Paypal",
        Date: "04.10.2022",
        Amount: "$1000",
        Class: "custom-badge status-green dropdown-toggle",
        Status: "Approved",
    },
    {
        Image: "avatar-01.jpg",
        Item: "Aspiration Pump",
        PurchaseFrom: "Medi Pro Service",
        Purchaseby: "Andrea Lalema",
        Paidby: "Cheque",
        Date: "06.10.2022",
        Amount: "$4000",
        Class: "custom-badge status-pink dropdown-toggle",
        Status: "Rejected",
    },
    {
        Image: "avatar-02.jpg",
        Item: "Medical Expenses",
        PurchaseFrom: "Hi-life Medicals",
        Purchaseby: "Smith Bruklin",
        Paidby: "Debit Card",
        Date: "04.10.2022",
        Amount: "$1000",
        Class: "custom-badge status-green dropdown-toggle",
        Status: "Approved",
    },
];
export default {
    data() {
        return {
            data,
            columns,
            title: "Reports",
            text: "Expenses Report",
        };
    },
    components: {
        Reports_Head,
    },
};
</script>
