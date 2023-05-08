<script setup>
import { ref, defineEmits } from "vue";
import axios from "axios";

const emits = defineEmits(["created"]);
let titulo = ref("Preciso ir ao cinema");
let descricao = ref("Ir ao cinema");
let finalizado = ref();
let creatingTask = ref(false);

function novaTarefa() {
  creatingTask.value = true;
  axios
    .post("http://localhost:8000/api/task", {
      titulo: titulo.value,
      descricao: descricao.value,
    })
    .then((response) => {
      emits("created");
      // updateData()
      // tarefas.value.push(response.data);
    })
    .catch((response) => {
      alert(response.response.data.message);
    })
    .finally(() => {
      creatingTask.value = false;
    });
}
</script>
<template>
  <div class="bg-slate-50 mx-auto max-w-3xl mt-12 p-10 rounded-md">
    <form action="">
      <div class=""></div>
      <input
        type="text"
        class="w-full border border-solid border-gray-700 border-1 p-3 rounded-md text-stone-950 placeholder:text-stone-950"
        v-model="titulo"
        placeholder="Seu título"
      />
      <!-- <input type="date" class="w-full border border-solid border-gray-700 border-1 mt-3 p-3 rounded-md text-stone-950 placeholder:text-stone-950" name="finalizado"> -->
      <textarea
        rows="10"
        class="resize-none w-full border border-solid border-gray-700 border-1 mt-3 p-3 rounded-md text-stone-950 placeholder:text-stone-950"
        v-model="descricao"
      >
Descrição</textarea
      >
      <div class="flex justify-center mt-6">
        <button
          class="rounded-md bg-lime-700 text-stone-300 inline-block py-3 px-6 text-lg disabled:bg-zinc-800 disabled:text-gray-500 disabled:cursor-not-allowed"
          :disabled="creatingTask"
          @click.prevent="novaTarefa()"
        >
          Enviar
        </button>
      </div>
    </form>
  </div>
</template>
<style></style>
