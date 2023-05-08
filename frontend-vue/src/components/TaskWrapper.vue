<script setup>
import { ref, onMounted } from "vue";
import TaskForm from "./TaskForm.vue";
import Task from "./Task.vue"
import axios from "axios";

let tarefas = ref([]);
let loadingTaks = ref(false);

function updateData() {
  loadingTaks.value = true;
  tarefas.value = [];
  axios
    .get("http://localhost:8000/api/task")
    .then(function (response) {
      tarefas.value = response.data;
    })
    .catch(function (error) {
      console.log(error);
    })
    .finally(() => {
      loadingTaks.value = false;
    });
}

onMounted(() => {
  updateData();
});


</script>
<template>
  <TaskForm @created="updateData" />
  <div v-if="loadingTaks" class="text-center text-4xl mt-8 text-zinc-50">
    Carregando, aguarde
  </div>
  <div
    v-if="!loadingTaks && !tarefas.length"
    class="text-center text-4xl mt-8 text-zinc-50"
  >
    Nenhuma tarefa cadastradas
  </div>
  <ul v-if="tarefas">
    <Task v-for="tarefa in tarefas" :tarefa="tarefa" @update="updateData" />
  </ul>
</template>

<style></style>
