<script setup>
import AdminDashboard from "@/views/Backend/Dashboard/Admin/Index.vue";
import DoctorDashboard from "@/views/Backend/Dashboard/Doctor/Index.vue";
import PatientDashboard from "@/views/Backend/Dashboard/Patient/Index.vue";
import { ADMIN, DOCTOR } from "@/enums/role.js";
</script>

<template>
    <admin-dashboard v-if="$can(ADMIN)" />
    <doctor-dashboard v-else-if="$can(DOCTOR)" />
    <patient-dashboard v-else />
</template>
