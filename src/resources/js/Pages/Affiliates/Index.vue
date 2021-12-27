<template>
  <div>
    <Head title="Affiliates"/>
    <h1 class="mb-8 text-3xl font-bold">Affiliates</h1>
    <div class="flex items-center justify-between mb-6 max-w-xs">
      <label class="block text-gray-700">Distance:</label>
      <select v-model="form.distance" class="form-select mt-1 ml-1 w-full">
        <option :value="null"/>
        <option v-for="n in getNumbers(25,200,25)" :value="n">{{ n }}</option>
        <option v-for="k in getNumbers(250,500,50)" :value="k">{{ k }}</option>
      </select>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Affiliate Id</th>
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Distance</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="affiliate in affiliates.data" :key="affiliate.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <div class="flex items-center px-6 py-4" tabindex="-1">
              {{ affiliate.affiliate_id }}
            </div>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4" tabindex="-1">
              {{ affiliate.name }}
            </div>
          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4" tabindex="-1">
              {{ affiliate.distance }}
            </div>
          </td>
        </tr>
        <tr v-if="affiliates.data.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No affiliates found.</td>
        </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="affiliates.links"/>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    affiliates: Object,
  },
  data() {
    return {
      form: {
        distance: this.filters.distance,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/affiliates', pickBy(this.form), {preserveState: true})
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    getNumbers: function (start, stop, step = 1) {
      return new Array((stop - start) / step + 1).fill(start).map((n, i) => n + i * step);
    },
  },
}
</script>
