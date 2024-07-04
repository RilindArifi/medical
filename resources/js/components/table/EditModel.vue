<script setup>
const props = defineProps({
    id: Number,
    model: String,
});
</script>

<template>
    <router-link
        v-if="$can(`edit ${model}`)"
        class="d-flex"
        :to="{ name: `${model}.edit`, params: { id: id } }"
    >
        <li>
            <i class="fa-solid fa-pen-to-square"></i>
        </li>
    </router-link>
</template>

<style scoped></style>
