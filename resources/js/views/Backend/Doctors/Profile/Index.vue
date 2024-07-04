<script setup>
import LayoutProfile from "@/views/Backend/Doctors/Profile/Layout/Index.vue";
import General from "@/views/Backend/Doctors/Profile/Layout/General.vue";
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb title="Doctors" text="Doctor Profile" path="/doctors" />
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <general />
                    </div>
                    <layout-profile />
                </div>
            </div>
        </div>
    </div>
</template>
