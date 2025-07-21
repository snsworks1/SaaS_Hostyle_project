<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900">
    <div v-if="!done" class="flex flex-col items-center">
      <svg class="animate-spin h-12 w-12 text-purple-400 mb-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
      </svg>
      <div class="text-2xl text-white font-bold mb-2">서버를 생성중입니다...</div>
      <div class="text-white/70 text-sm">최대 1분 정도 소요될 수 있습니다.</div>
    </div>
    <div v-else class="flex flex-col items-center">
      <svg class="h-12 w-12 text-green-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
      <div class="text-2xl text-green-400 font-bold mb-2">생성이 완료되었습니다!</div>
      <div class="text-white/70 text-sm">잠시 후 서버 선택 페이지로 이동합니다.</div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { router } from '@inertiajs/vue3';

const done = ref(false);

onMounted(() => {
  setTimeout(() => {
    done.value = true;
    setTimeout(() => {
      router.visit(route('server.select'));
    }, 1000); // 완료 메시지 1초 노출 후 이동
  }, 5000); // 최소 5초 로딩
});
</script> 