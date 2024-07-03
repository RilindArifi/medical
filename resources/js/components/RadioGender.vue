<script setup>
import {FEMALE, MALE} from "@/enums/gender-global.js";
</script>

<template>
  <a-radio-group>
    <a-radio :value="MALE">{{MALE}}</a-radio>
    <a-radio :value="FEMALE">{{FEMALE}}</a-radio>
  </a-radio-group>
</template>