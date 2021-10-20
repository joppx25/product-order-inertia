<template>
  <app-layout>
    <form @submit.prevent="submit" class="w-full max-w-lg xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-10">
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
            Title
          </label>
          <input v-model="form.title" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="title" type="text">
          <p class="text-gray-600 text-xs italic">Remove if not needed</p>
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-1/2 px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
            Price
          </label>
          <input v-model="form.price" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="price" type="number">
          <p class="text-gray-600 text-xs italic">Some tips - as long as needed</p>
        </div>
        <div class="w-1/2 px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="quantity">
            Quantity
          </label>
          <input v-model="form.quantity" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="quantity" type="number">
          <p class="text-gray-600 text-xs italic">Some tips - as long as needed</p>
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
            Description
          </label>
          <textarea v-model="form.description" class=" no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" id="description"></textarea>
          <p class="text-gray-600 text-xs italic">Re-size can be disabled by set by resize-none / resize-y / resize-x / resize</p>
        </div>
      </div>
      <div v-if="!form.image" class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Upload Photo</label>
          <div class='flex items-center justify-center w-full'>
              <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                  <div class='flex flex-col items-center justify-center pt-7'>
                    <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a photo</p>
                  </div>
                <input @change="onFileChange" type='file' class="hidden" />
              </label>
          </div>
      </div>
      <div v-else class="grid grid-cols-1 mt-5 mx-7">
        <img ref="form.image" :src="form.imageUrl" />
        <button @click="removeImage">Remove image</button>
      </div>

      <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
        <button class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Create</button>
      </div>
    </form>
  </app-layout>
</template>
<script>
  import AppLayout from '@/Layouts/AppLayout.vue'
  import { ref, reactive } from 'vue'
  import { Inertia } from '@inertiajs/inertia'
  export default {
    components: {
      AppLayout
    },
    data () {
      return {
        // title: '',
        // price: 0,
        // quantity: 0,
        // description: '',
        // image: '',
      }
    },
    methods: {
      // onFileChange(e) {
      //   let files = e.target.files || e.dataTransfer.files;
      //   if (!files.length) return;
      //   this.fileObject = files[0];
      //   this.createImage(files[0]);
      // },

      // createImage(file) {
      //   let image  = new Image();
      //   let reader = new FileReader();
      //   let _vm    = this;

        // reader.onload = (e) => {
        //   _vm.image = e.target.result;
        // };

        // reader.readAsDataURL(file);
      // },

      // removeImage: function (e) {
      //   this.image = '';
      // }
    },
    setup () {
      const form = reactive({
        title: null,
        price: 0,
        quantity: 0,
        description: '',
        image: ref(null),
        imageUrl: ref(''),
      });

      function submit() {
        Inertia.post('/products/store', form);
      }

      function onFileChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length) return;
        form.image = files[0];
        this.createImage(files[0]);
      }
      
      function createImage(file) {
        let reader = new FileReader();
        reader.onload = (e) => {
          form.imageUrl = e.target.result;
        };

        reader.readAsDataURL(file);
      }

      function removeImage (e) {
        form.imageUrl = '';
      }

      return { submit, form, onFileChange, createImage, removeImage };
    }
  }
</script>