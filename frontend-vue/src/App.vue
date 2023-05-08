<script setup>
import { ref } from "vue";
import TaskWrapper from "./components/TaskWrapper.vue";

const taskWrapperRef = ref(null);

const formCreated = () => {
  console.log("Aqui deveria avisa o Wrapper que uma nova tarefa foi criada");
  taskWrapperRef.value.updateData();
};
//
</script>
<template>
  <div class="bg-slate-900 min-h-screen py-8">
    <h1 class="text-5xl text-center text-stone-200">To Do List do Miguel</h1>
    <TaskWrapper></TaskWrapper>
  </div>
</template>
<style></style>
