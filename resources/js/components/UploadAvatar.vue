<script setup>
import { ref } from 'vue';
import { message } from 'ant-design-vue';
import {PlusOutlined} from "@ant-design/icons-vue";

  const
      props = defineProps({
        state: Object,
      }),
      loading = ref(false),
      imageUrl = ref(''),

      handleChange = file => {
        file = file.target.files[0];
        console.log(file)
        const isJpgOrPng = file.type.includes('image/jpeg') || file.type.includes('image/png') || file.type.includes('image/jpg');
        if (!isJpgOrPng) {
          message.error('You can only upload JPG file!');
        }
        const isLt2M = file.size / 1024 / 1024 < 2;
        if (!isLt2M) {
          message.error('Image must smaller than 2MB!');
        }
        props.state.avatar = file
      }

</script>



<template>
  <label class="local-top">Avatar</label>
  <div class="settings-btn upload-files-avator">
    <input
        type="file"
        accept="image/*"
        name="image"
        id="file"
        @change="handleChange"
        class="hide-input"
    />
    <label for="file" class="upload">Choose File</label>
  </div>
</template>
