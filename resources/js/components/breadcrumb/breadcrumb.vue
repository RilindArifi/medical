<template>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link :to="path">{{ title }} </router-link>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="feather-chevron-right"></i>
                    </li>
                    <li class="breadcrumb-item active">{{ text }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
</template>
<script>
export default {
    props: {
        title: {
            type: String,
            default: "",
        },
        text: {
            type: String,
            default: "",
        },
        path: {
            type: String,
            default: "",
        },
    },
};
</script>
