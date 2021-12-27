<template>
  <div>
    <Head title="Dashboard"/>
    <h1 class="mb-8 text-3xl font-bold">Welcome</h1>
    <p class="mb-8 leading-normal">Hey there! Welcome to the affiliates Demo app, to get started, upload an affiliates
      file on the form bellow.</p>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <file-input label="Affiliates file" v-model="form.file" :error="form.errors.file" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept=".txt" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Upload Affiliates</loading-button>
        </div>
      </form>

    </div>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import FileInput from '@/Shared/FileInput'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    FileInput
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        '_method': 'PUT',
        file: null,
      }, {
        resetOnSuccess: false,
      }),
    }
  },
  methods: {
    store() {
      if (this.$refs.file) {
        this.form.file = this.$refs.file.files[0]
      }
      this.form.post('/affiliates')
    },
  },
}
</script>
