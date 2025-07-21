

<template>
    <div class="min-h-screen bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900">
        <!-- 헤더 컴포넌트 -->
        <ServerHeader :server="server" :all-servers="allServers" @dropdown-toggle="handleDropdownToggle" />
        
        <!-- 드롭다운 오버레이: 드롭다운이 열렸을 때만 헤더 바로 아래에 위치 -->
        <div v-if="isDropdownOpen" class="fixed left-0 right-0 top-[64px] h-[300px] z-[999]" style="pointer-events:auto;"></div>
        
        <div class="flex relative z-0">
            <!-- 사이드바 컴포넌트 -->
            <ServerSidebar :sidebar-menus="sidebarMenus" :plan="server.plan" :server-id="server.id" />

            <!-- 메인 콘텐츠 -->
            <div class="flex-1 p-8 relative z-0 transition-all duration-300">
                <div class="max-w-7xl mx-auto">
                    <!-- 페이지 제목 -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-white mb-2">서버 정보</h1>
                        <p class="text-white/60">서버의 기본 정보와 관리 옵션을 확인하세요.</p>
                    </div>

                    <!-- 서버 정보 카드들 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- 기본 정보 -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-6">
                            <h2 class="text-xl font-semibold text-white mb-4">기본 정보</h2>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-white/70">사이트 이름</span>
                                    <span class="text-white font-medium">{{ server.site_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/70">도메인</span>
                                    <span class="text-white font-medium">{{ server.domain }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/70">플랫폼</span>
                                    <span class="text-white font-medium">{{ server.platform }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/70">지역</span>
                                    <span class="text-white font-medium">{{ server.region }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- 결제 정보 -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-6">
                            <h2 class="text-xl font-semibold text-white mb-4">결제 정보</h2>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-white/70">플랜</span>
                                    <span class="text-white font-medium">{{ server.plan }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/70">기간</span>
                                    <span class="text-white font-medium">{{ server.period }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/70">생성일</span>
                                    <span class="text-white font-medium">{{ server.created_at }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/70">만료일</span>
                                    <span class="text-white font-medium">{{ server.expires_at }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 액션 카드들 -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-6 hover:bg-white/20 transition-all duration-300 cursor-pointer">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-bold">사이트 설정</div>
                                    <div class="text-white/50 text-sm">도메인, SEO, 소셜 설정</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-6 hover:bg-white/20 transition-all duration-300 cursor-pointer">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-bold">통계 보기</div>
                                    <div class="text-white/50 text-sm">방문자, 접속 통계</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-6 hover:bg-white/20 transition-all duration-300 cursor-pointer">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-bold">서버 관리</div>
                                    <div class="text-white/50 text-sm">PHP, MySQL, SSL 설정</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import ServerHeader from '@/Components/ServerHeader.vue';
import ServerSidebar from '@/Components/ServerSidebar.vue';

console.log('servers:', usePage().props.servers);

const isDropdownOpen = ref(false);

const handleDropdownToggle = (isOpen) => {
    isDropdownOpen.value = isOpen;
};

defineProps({
    server: {
        type: Object,
        required: true
    },
    allServers: {
        type: Array,
        default: () => []
    },
    sidebarMenus: {
        type: Array,
        default: () => []
    }
});
</script>

<style scoped>
/* Add any specific styles here if needed */
</style> 