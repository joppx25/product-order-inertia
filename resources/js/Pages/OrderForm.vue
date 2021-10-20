<template>
  <app-layout>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">
      <div class="relative inline-flex">
        <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
        <select v-model="selected_product" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
          <option value="">Choose a product</option>
          <option v-for="(product, index) in products" :key="index" :value="product">{{ product.title }}</option>
        </select>
      </div>
      <div class="relative inline-flex">
        <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
        <select v-model="selected_category" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
          <option value="">Choose a category</option>
          <option v-for="(category, index) in categories" :key="index" :value="category">{{ category.name }}</option>
        </select>
      </div>
      <div class="relative inline-flex">
        <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
        <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
          <option value="">Choose a sub category</option>
          <option v-for="(sub_category, index) in selected_sub_category" :key="index" :value="sub_category">{{ sub_category.name }}</option>
        </select>
      </div>
      
      <div v-if="selected_product.quantity > 0" class="max-w-sm rounded overflow-hidden shadow-lg mt-10">
        <img class="w-full" src="https://v1.tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
          <p class="text-gray-700 text-base">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
          </p>
        </div>
        <form @submit.prevent="submit">
          <div class="px-6 pt-4 pb-2">
            <label for="quantity" class="text-gray-700 text-sm font-bold mb-2 float-left">Current available qty: {{ selected_product.quantity }}</label>
            <label class="text-gray-700 font-bold text-xl float-right">${{ selected_product.price }}</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline appearance-none" type="number" placeholder="quantity"  v-model="form.quantity" />
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 w-full">Buy</button>
          </div>
        </form>
      </div>
    </section>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    products: Object,
    categories: Object,
    sub_categories: Object,
  },
  components: {
    AppLayout
  },
  watch: {
    selected_product: function (product) {
      this.selected_category = product !== '' ? product.category : ''; 
    },
    selected_category: function (category) {
      let current_sub_categories = _.filter(this.sub_categories, function (sub) { return sub.parent_id === category.id });
      this.selected_sub_category = _.isEmpty(current_sub_categories) ? '' : current_sub_categories;
    }
  },
  data() {
    return {
      selected_product: '',
      selected_category: '',
      selected_sub_category: ''
    }
  },
  methods: {},
  setup () {
    const form = reactive({
      quantity: null,
      product_id: null,
    });

    function submit() {
      Inertia.post('/orders', form);
    }

    return { submit, form };
  }
}
</script>