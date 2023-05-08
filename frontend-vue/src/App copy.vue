<script setup>
  import {ref, onMounted} from 'vue';
  import axios from 'axios';

  let titulo = ref('Preciso ir ao cinema');
  let descricao = ref('Ir ao cinema');
  let finalizado = ref();
  let creatingTask = ref(false);
  
  let loadingTaks = ref(false);
  let tarefas = ref([]);
  
  function novaTarefa() {
    creatingTask.value = true;
    axios.post('http://localhost:8000/api/task', {
      titulo: titulo.value,
      descricao : descricao.value,
    })
    .then((response)=>{
      // updateData()
      tarefas.value.push(response.data)
    })
    .finally(()=>{
      creatingTask.value = false
    })
  }
  onMounted(()=>{
    updateData()
  })
  function updateData(clean = false) {
    loadingTaks.value = true;
    tarefas.value = [];
    axios.get('http://localhost:8000/api/task')
    .then(function(response){
      tarefas.value = response.data
    })
    .catch(function(error){
      console.log(error)
    })
    .finally(()=>{
      loadingTaks.value = false;
    })
  }
</script>

<template>
  <div class="bg-slate-900 min-h-screen py-8">
    <h1 class="text-5xl text-center text-stone-200">To Do List do Miguel</h1>
  </div>

  <div v-if="loadingTaks" class="text-center text-4xl mt-8 text-zinc-50">Carregando, aguarde</div>
  <div v-if="!loadingTaks && !tarefas.length" class="text-center text-4xl mt-8 text-zinc-50">Nenhuma tarefa cadastradas</div>
  <ul v-if="tarefas">
    <li class="bg-slate-50 mx-auto max-w-3xl mt-10 p-10 rounded-md"  v-for="tarefa in tarefas">
      <div class="border border-solid border-gray-700 p-3">
        <div class="text-lg font-bold">
          {{ tarefa.title }}
        </div>
        <div class="mt-2 text-md">
            {{ tarefa.description }}
        </div>
        <div v-if="tarefa.finished_at">
          <div class="data mt-2 text-sm font-bold">
            Finalizada em: {{ tarefa.finished_at }}
          </div>
        </div>
        <div v-else class="mt-2">
          <form action="">
            <div class="block w-full">
              <label class="block">Finalizar : </label><input class="mt-3" type="date" v-model="finalizado">
            </div>
            <button class="mt-2 inline-block rounded-md bg-cyan-800 text-stone-300 p-2">
              Atualizar
            </button>
          </form>
        </div>
        <div class="flex mt-6">
          <div class="rounded-md bg-red-700 text-stone-300 inline-block py-3 px-6 text-lg">
            Deletar
          </div>
        </div>
      </div>
    </li>
  </ul>
  </div>
</template>
<style></style>