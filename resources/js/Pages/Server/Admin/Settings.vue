<script setup>
import { usePage } from '@inertiajs/vue3';
import ServerHeader from '@/Components/ServerHeader.vue';
import ServerSidebar from '@/Components/ServerSidebar.vue';

const page = usePage();
const server = page.props.server || {};
const allServers = page.props.allServers || [];
const sidebarMenus = page.props.sidebarMenus || [];

const sampleUsers = [
  { id: 1, name: 'dbuser1', role: '읽기/쓰기' },
  { id: 2, name: 'dbuser2', role: '읽기전용' },
];
</script>
<template>
  <div class="min-h-screen bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900">
    <ServerHeader :server="server" :all-servers="allServers" />
    <div class="flex relative z-0">
      <ServerSidebar :sidebar-menus="sidebarMenus" :plan="server.plan" :server-id="server.id" />
      <div class="flex-1 p-8 relative z-0 transition-all duration-300">
        <div class="max-w-3xl mx-auto py-10 px-4 space-y-10">
          <h1 class="text-3xl font-bold text-white mb-4">서버관리 설정</h1>
          <p class="text-white/70 mb-8">PHP 버전, MySQL 패스워드, MySQL 유저 등 서버의 주요 설정을 한 번에 관리할 수 있습니다.</p>
          <!-- PHP 버전 설정 -->
          <div class="bg-white/10 rounded-xl border border-white/20 p-6 mb-6">
            <h2 class="text-xl font-bold text-white mb-4">PHP 버전설정</h2>
            <form class="flex items-center space-x-4">
              <select class="bg-white/10 border border-white/20 rounded-lg text-white p-3">
                <option>8.2</option>
                <option>8.1</option>
                <option>7.4</option>
              </select>
              <button class="bg-gradient-to-r from-purple-500 to-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:from-purple-600 hover:to-blue-600 transition">저장</button>
            </form>
          </div>
          <!-- MySQL 패스워드 변경 -->
          <div class="bg-white/10 rounded-xl border border-white/20 p-6 mb-6">
            <h2 class="text-xl font-bold text-white mb-4">MySQL 패스워드 변경</h2>
            <form class="flex items-center space-x-4">
              <input type="password" class="bg-white/10 border border-white/20 rounded-lg text-white p-3" placeholder="새 비밀번호 입력" />
              <button class="bg-gradient-to-r from-purple-500 to-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:from-purple-600 hover:to-blue-600 transition">변경</button>
            </form>
          </div>
          <!-- MySQL 유저 관리 -->
          <div class="bg-white/10 rounded-xl border border-white/20 p-6">
            <h2 class="text-xl font-bold text-white mb-4">MySQL 유저 관리</h2>
            <div class="flex justify-end mb-4">
              <button class="bg-gradient-to-r from-purple-500 to-blue-500 text-white px-5 py-2 rounded-lg font-semibold hover:from-purple-600 hover:to-blue-600 transition">+ 유저 추가</button>
            </div>
            <table class="min-w-full text-white">
              <thead>
                <tr class="bg-white/10">
                  <th class="px-4 py-3 text-left">유저명</th>
                  <th class="px-4 py-3 text-left">권한</th>
                  <th class="px-4 py-3 text-left">관리</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in sampleUsers" :key="user.id" class="border-b border-white/10">
                  <td class="px-4 py-2">{{ user.name }}</td>
                  <td class="px-4 py-2">{{ user.role }}</td>
                  <td class="px-4 py-2">
                    <button class="text-blue-400 hover:underline mr-2">설정</button>
                    <button class="text-red-400 hover:underline">삭제</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div v-if="sampleUsers.length === 0" class="text-center text-white/60 py-8">등록된 유저가 없습니다.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template> 