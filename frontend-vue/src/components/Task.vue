<script setup>
import { defineProps, ref, defineEmits } from "vue";
import axios from "axios";

const props = defineProps({
  tarefa: Object,
});
const emits = defineEmits(["update"]);

function remove() {
  if (!confirm("Você está certo disso? Não terá volta")) {
    return false;
  }
  props.tarefa.deleting = true;
  axios
    .delete("http://localhost:8000/api/task/" + props.tarefa.id)
    .then(function (response) {
      emits("update");
    })
    .catch(function (error) {
      console.log(error);
    })
    .finally(() => {
      props.tarefa.deleting = false;
    });
}

function update() {
  props.tarefa.sending = true;
  axios
    .put("http://localhost:8000/api/task/" + props.tarefa.id, {
      titulo: props.tarefa.title,
      descricao: props.tarefa.description,
      finalizado: props.tarefa.finished_at?.split("-").reverse().join("/"),
    })
    .then(function (response) {
      emits("update");
    })
    .catch(function (error) {
      alert(response.response.data.message);
    })
    .finally(() => {
      props.tarefa.editting = false;
      props.tarefa.sending = false;
    });
}
</script>
<template>
  <li class="bg-slate-50 mx-auto max-w-3xl mt-10 p-2 rounded-md">
    <div class="p-3">
      <form>
        <div class="block w-full">
          <span class="mt-2 block text-lg">Título</span>
          <input
            type="text"
            v-model="tarefa.title"
            :readonly="!tarefa.editting"
            :class="{ 'cursor-default outline-none': !tarefa.editting }"
            class="mt-2 w-full p-2"
          />
        </div>
        <div class="block w-full">
          <span class="mt-2 block text-lg">Texto</span>
          <textarea
            rows="5"
            v-model="tarefa.description"
            :readonly="!tarefa.editting"
            :class="{ 'cursor-default outline-none': !tarefa.editting }"
            class="mt-2 w-full p-2 resize-none"
          ></textarea>
        </div>
        <div class="block w-full">
          <span class="mt-2 block text-lg">Finalizado em:</span>
          <input
            v-model="tarefa.finished_at"
            type="date"
            :class="{ 'cursor-default outline-none': !tarefa.editting }"
            class="mt-2 w-full p-2 resize-none"
          />
        </div>
      </form>
      <div class="flex justify-center mt-10">
        <button
          class="mr-2 inline-block rounded-md bg-cyan-800 text-stone-300 p-2"
          v-if="!tarefa.editting && !tarefa.deleting"
          @click.prevent="tarefa.editting = true"
        >
          Atualizar
        </button>
        <button
          v-else
          @click.prevent="update()"
          class="mr-2 inline-block rounded-md bg-cyan-800 text-stone-300 p-2 disabled:bg-zinc-800 disabled:text-gray-500 disabled:cursor-not-allowed"
          :disabled="tarefa.sending || tarefa.deleting"
        >
          Salvar
        </button>
        <button
          @click.prevent="remove()"
          class="rounded-md bg-red-700 cursor-pointer text-stone-300 inline-block p-2 disabled:bg-zinc-800 disabled:text-gray-500 disabled:cursor-not-allowed"
          :disabled="tarefa.deleting || tarefa.sending"
        >
          Deletar
        </button>
      </div>
    </div>
  </li>
</template>
<style></style>
