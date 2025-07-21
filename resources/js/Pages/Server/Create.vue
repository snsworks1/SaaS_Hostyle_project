<script setup>
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// props로 DB에서 가져온 플랜 데이터 받기
const props = defineProps({
    plans: {
        type: Array,
        default: () => []
    }
});

const form = useForm({
    site_name: '',
    domain: '',
    region: 'seoul',
    platform: 'wordpress',
    plan: 'starter',
    months: 1
});

const months = [
    { value: 1, label: '1개월', discount: 0 },
    { value: 3, label: '3개월', discount: 5 },
    { value: 6, label: '6개월', discount: 10 },
    { value: 12, label: '1년', discount: 20 }
];

const regions = [
    { value: 'seoul', label: '서울 (한국)', flag: '🇰🇷', country: 'Korea' },
    { value: 'tokyo', label: '도쿄 (일본)', flag: '🇯🇵', country: 'Japan' },
    { value: 'singapore', label: '싱가포르', flag: '🇸🇬', country: 'Singapore' },
    { value: 'frankfurt', label: '프랑크푸르트 (독일)', flag: '🇩🇪', country: 'Germany' },
    { value: 'virginia', label: '버지니아 (미국)', flag: '🇺🇸', country: 'USA' }
];

const platforms = [
    { value: 'wordpress', label: 'WordPress', icon: '/images/payment_icon/wordpress.png', description: '블로그, 포트폴리오, 쇼핑몰 등' },
    { value: 'cms', label: 'Hostyle 웹 제작 플랫폼', icon: '/images/payment_icon/cms.png', description: '드래그앤드롭 간편한 웹제작 플랫폼' },
    { value: 'custom', label: '자체구축', icon: '/images/payment_icon/자체구축.png', description: 'PHP / HTML / CSS / JavaScript' }
];

// DB에서 가져온 플랜 데이터 사용 (props.plans가 비어있으면 기본값 사용)
const plans = props.plans.length > 0 ? props.plans : [
    { 
        value: 'free', 
        label: '무료', 
        price: '0',
        originalPrice: '0',
        trialDays: 15,
        specs: {
            storage: '1GB',
            traffic: '10GB/월',
            domains: '서브도메인',
            features: ['SEO', '고급 템플릿', '드래그앤드랍 빌더', '실시간 모니터링']
        }
    },
    { 
        value: 'starter', 
        label: 'Starter', 
        price: '9,900',
        originalPrice: '9,900',
        annualPrice: '8,900',
        specs: {
            storage: '5GB',
            traffic: '150GB/월',
            domains: '1개',
            features: ['SEO', 'SSL', 'SSL 인증서', '개별도메인', '게시판', '고급 템플릿', '드래그앤드랍 빌더', '실시간 모니터링', 'Hostyle 광고제거']
        }
    },
    { 
        value: 'business', 
        label: 'Business', 
        price: '19,900',
        originalPrice: '19,900',
        annualPrice: '17,900',
        specs: {
            storage: '20GB',
            traffic: '600GB/월',
            domains: '5개',
            features: ['SEO', 'SSL', 'SSL 인증서', '개별도메인', '게시판', '고급 분석', '고급 템플릿', '드래그앤드랍 빌더', '백업', '실시간 모니터링', '방문자 모니터링', '이메일 지원', 'Hostyle 광고제거', '커스텀 스크립트', '회원관리']
        }
    },
    { 
        value: 'enterprise', 
        label: 'Enterprise', 
        price: '39,900',
        originalPrice: '39,900',
        annualPrice: '35,900',
        specs: {
            storage: '100GB',
            traffic: '무제한',
            domains: '무제한',
            features: ['SEO', 'SSL', 'SSL 인증서', '개별도메인', '게시판', '고급 분석', '고급 템플릿', '드래그앤드랍 빌더', '백업', '실시간 모니터링', '방문자 모니터링', '이메일 지원', '전용 IP', 'Hostyle 광고제거', '커스텀 스크립트', '회원관리']
        }
    }
];

const selectedPlan = ref(plans.find(p => p.value === form.plan));

// 플랜 변경 시 selectedPlan 업데이트
const updateSelectedPlan = () => {
    selectedPlan.value = plans.find(p => p.value === form.plan);
};

// 할인된 가격 계산
const getDiscountedPrice = (plan, months) => {
    const basePrice = parseInt(plan.price.replace(/,/g, ''));
    const selectedMonth = months.find(m => m.value === form.months);
    const discount = selectedMonth ? selectedMonth.discount : 0;
    return Math.round(basePrice * form.months * (1 - discount / 100));
};

const submit = () => {
    form.post(route('server.payment.dummy'));
};
</script>

<template>
    <Head title="서버 생성" />

    <div class="min-h-screen bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900">
        <!-- 헤더 -->
        <div class="bg-white/10 backdrop-blur-xl border-b border-white/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-2xl font-bold text-white">HOSTYLE</h1>
                        <span class="text-white/70">서버 생성</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <Link 
                            :href="route('server.select')" 
                            class="text-white/70 hover:text-white transition-colors"
                        >
                            서버 목록으로
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- 메인 컨텐츠 -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">새 서버를 생성하세요</h2>
                <p class="text-xl text-white/70">몇 가지 정보만 입력하면 바로 시작할 수 있습니다</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- 메인 폼 -->
                <div class="flex-1">
                    <form @submit.prevent="submit" class="space-y-8">
                        <!-- 1단계: 사이트 정보 -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-8">
                            <h3 class="text-2xl font-bold text-white mb-6">1. 사이트 정보</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- 사이트 이름 -->
                                <div>
                                    <label class="block text-white font-medium mb-2">사이트 이름 *</label>
                                    <input 
                                        v-model="form.site_name"
                                        type="text"
                                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:border-purple-400 focus:outline-none transition-colors"
                                        placeholder="예: 내 블로그"
                                        required
                                    >
                                    <div v-if="form.errors.site_name" class="mt-2 text-red-300 text-sm">{{ form.errors.site_name }}</div>
                                </div>

                                <!-- 도메인 -->
                                <div>
                                    <label class="block text-white font-medium mb-2">도메인 *</label>
                                    <div class="relative">
                                        <input 
                                            v-model="form.domain"
                                            type="text"
                                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:border-purple-400 focus:outline-none transition-colors pr-20"
                                            placeholder="예: myblog"
                                            required
                                        >
                                        <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/50">.hostyle.com</span>
                                    </div>
                                    <div v-if="form.errors.domain" class="mt-2 text-red-300 text-sm">{{ form.errors.domain }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- 2단계: 리전 선택 -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-8">
                            <h3 class="text-2xl font-bold text-white mb-6">2. 서버 리전 선택</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div 
                                    v-for="region in regions" 
                                    :key="region.value"
                                    :class="[
                                        'p-4 border-2 rounded-lg cursor-pointer transition-all duration-300',
                                        form.region === region.value 
                                            ? 'border-purple-400 bg-purple-500/20' 
                                            : 'border-white/20 bg-white/5 hover:bg-white/10'
                                    ]"
                                    @click="form.region = region.value"
                                >
                                    <div class="flex items-center space-x-3">
                                        <span class="text-2xl">{{ region.flag }}</span>
                                        <div>
                                            <div class="text-white font-medium">{{ region.label }}</div>
                                            <div class="text-white/60 text-sm">{{ region.country }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3단계: 플랫폼 선택 -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-8">
                            <h3 class="text-2xl font-bold text-white mb-6">3. 플랫폼 선택</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div 
                                    v-for="platform in platforms" 
                                    :key="platform.value"
                                    :class="[
                                        'p-6 border-2 rounded-lg cursor-pointer transition-all duration-300',
                                        form.platform === platform.value 
                                            ? 'border-purple-400 bg-purple-500/20' 
                                            : 'border-white/20 bg-white/5 hover:bg-white/10'
                                    ]"
                                    @click="form.platform = platform.value"
                                >
                                    <div class="text-center">
                                        <div class="w-16 h-16 mx-auto mb-4 bg-white/10 rounded-lg flex items-center justify-center">
                                            <span class="text-2xl">🚀</span>
                                        </div>
                                        <div class="text-white font-bold mb-2">{{ platform.label }}</div>
                                        <div class="text-white/60 text-sm">{{ platform.description }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4단계: 요금제 선택 -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-8">
                            <h3 class="text-2xl font-bold text-white mb-6">4. 요금제 선택</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div 
                                    v-for="plan in plans" 
                                    :key="plan.value"
                                    :class="[
                                        'p-6 border-2 rounded-lg cursor-pointer transition-all duration-300',
                                        form.plan === plan.value 
                                            ? 'border-purple-400 bg-purple-500/20' 
                                            : 'border-white/20 bg-white/5 hover:bg-white/10'
                                    ]"
                                    @click="form.plan = plan.value; updateSelectedPlan()"
                                >
                                    <div class="text-center">
                                        <div class="text-white font-bold text-xl mb-2">{{ plan.label }}</div>
                                        <div class="text-white/60 text-sm mb-4">
                                            <template v-if="plan.value === 'free'">개인 실험/테스트, 소규모 임시 사이트에 적합</template>
                                            <template v-else-if="plan.value === 'starter'">개인 블로그, 포트폴리오, 소규모 홈페이지 추천</template>
                                            <template v-else-if="plan.value === 'business'">중소기업, 단체, 트래픽 많은 사이트에 추천</template>
                                            <template v-else-if="plan.value === 'enterprise'">대규모 서비스, 기업/기관, 고성능이 필요한 경우</template>
                                        </div>
                                        <div class="text-white font-bold text-2xl mb-2">₩{{ plan.price }}/월</div>
                                        <div class="text-white/60 text-sm">
                                            {{ plan.specs.storage }} • {{ plan.specs.traffic }} • {{ plan.specs.domains }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5단계: 결제 기간 -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-8">
                            <h3 class="text-2xl font-bold text-white mb-6">5. 결제 기간</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div 
                                    v-for="month in months" 
                                    :key="month.value"
                                    :class="[
                                        'p-4 border-2 rounded-lg cursor-pointer transition-all duration-300',
                                        form.months === month.value 
                                            ? 'border-purple-400 bg-purple-500/20' 
                                            : 'border-white/20 bg-white/5 hover:bg-white/10'
                                    ]"
                                    @click="form.months = month.value"
                                >
                                    <div class="text-center">
                                        <div class="text-white font-bold text-lg mb-1">{{ month.label }}</div>
                                        <div v-if="month.discount > 0" class="text-green-400 text-sm">{{ month.discount }}% 할인</div>
                                        <div v-else class="text-white/60 text-sm">할인 없음</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 결제 버튼 -->
                        <div class="text-center">
                            <button 
                                type="submit"
                                class="bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white font-bold py-4 px-8 rounded-lg text-lg transition-all duration-300 transform hover:scale-105"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing">처리중...</span>
                                <span v-else>서버 생성하기</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 사이드바: 선택된 플랜 정보 -->
                <div class="lg:w-96">
                    <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-white mb-4">선택된 요금제</h3>
                        
                        <div v-if="selectedPlan" class="space-y-4">
                            <div class="text-center p-4 bg-white/5 rounded-lg">
                                <div class="text-white font-bold text-2xl mb-2">{{ selectedPlan.label }}</div>
                                <div class="text-white/60 text-sm mb-4">
                                    <template v-if="selectedPlan.value === 'free'">개인 실험/테스트, 소규모 임시 사이트에 적합</template>
                                    <template v-else-if="selectedPlan.value === 'starter'">개인 블로그, 포트폴리오, 소규모 홈페이지 추천</template>
                                    <template v-else-if="selectedPlan.value === 'business'">중소기업, 단체, 트래픽 많은 사이트에 추천</template>
                                    <template v-else-if="selectedPlan.value === 'enterprise'">대규모 서비스, 기업/기관, 고성능이 필요한 경우</template>
                                </div>
                                <div class="text-white font-bold text-3xl mb-2">₩{{ selectedPlan.price }}/월</div>
                                <div class="text-white/60 text-sm">
                                    {{ selectedPlan.specs.storage }} • {{ selectedPlan.specs.traffic }} • {{ selectedPlan.specs.domains }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <h4 class="text-white font-semibold">포함 기능</h4>
                                <div class="space-y-1">
                                    <div 
                                        v-for="feature in selectedPlan.specs.features" 
                                        :key="feature"
                                        class="flex items-center space-x-2 text-white/80 text-sm"
                                    >
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>{{ feature }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-white/20 pt-4">
                                <div class="flex justify-between text-white/70 text-sm">
                                    <span>월 요금</span>
                                    <span>₩{{ selectedPlan.price }}</span>
                                </div>
                                <div class="flex justify-between text-white/70 text-sm">
                                    <span>결제 기간</span>
                                    <span>{{ months.find(m => m.value === form.months)?.label }}</span>
                                </div>
                                <div v-if="months.find(m => m.value === form.months)?.discount > 0" class="flex justify-between text-green-400 text-sm">
                                    <span>할인</span>
                                    <span>-{{ months.find(m => m.value === form.months)?.discount }}%</span>
                                </div>
                                <div class="flex justify-between text-white font-bold text-lg border-t border-white/20 pt-2 mt-2">
                                    <span>총 결제 금액</span>
                                    <span>₩{{ getDiscountedPrice(selectedPlan, months).toLocaleString() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template> 