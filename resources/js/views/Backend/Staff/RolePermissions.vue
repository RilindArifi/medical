<script setup>
import {onBeforeMount, ref,watch} from 'vue';
import useModelOperations from "@/composables/model-operations.js";

const
    props = defineProps({
      state: Object,
      fieldError: Function
    }),
    models       = useModelOperations('roles'),
    permission   = useModelOperations('permissions'),
    options      = ref([]),
    isLoading    = ref(false),
    expandedKeys = ref([]),
    checkedKeys  = ref(props.state.permissions_user?.map(permission => permission.name) ?? []),
    permissions  = ref([]),

    focusHandle = async (opened) => {
      if (opened) {
        await remoteMethod();
      }
    },
    fetchPermissions = () => {
      permission.fetchData()
          .then(response => {
            permissions.value = response.data
          })
    },

    remoteMethod = async (query) => {
      isLoading.value = true
      options.value = await models.remoteModel(query)
      isLoading.value = false
    },
    fieldError = (key) => {
      return props.fieldError(key)
    }

    watch(checkedKeys, () => {
      props.state.permissions_user = []
      const numericPattern = /\b\d+-\d+\b/;

      checkedKeys.value.forEach(element => {
        if (!numericPattern.test(element)) {
          props.state.permissions_user.push(element)
        }
      });
    })

    onBeforeMount(() => {
      remoteMethod()
      fetchPermissions()
    })
</script>

<template>
  <div class="input-block local-forms">
    <label>Role <span class="login-danger">*</span></label>
    <a-select
        v-model:value="state.role"
        mode="multiple"
        :loading="isLoading"
        show-search
        class="form-control"
        :options="options"
        @search="remoteMethod"
        @dropdownVisibleChange="focusHandle"
        :class="{ 'is-invalid': fieldError('role') }"
    ></a-select>
    <div class="invalid-feedback">{{ fieldError('role') }}</div>
  </div>
  <div class="input-block">
    <label>Permissions</label>
    <a-tree
        v-model:expandedKeys="expandedKeys"
        v-model:checkedKeys="checkedKeys"
        checkable
        :tree-data="permissions"
    />
  </div>
</template>

<style scoped>

.form-control{
  padding: 6px;
}
</style>