<script setup>
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import axios from 'axios';
import Modal from '@/Components/Modal.vue';

// props로 DB에서 가져온 플랜 데이터 받기
const props = defineProps({
    plans: {
        type: Array,
        default: () => []
    },
    regions: {
        type: Array,
        default: () => []
    },
    features: {
        type: Array,
        default: () => []
    },
    featurePlan: {
        type: Array,
        default: () => []
    }
});

// const plans = props.plans; // 중복 선언 제거

const form = useForm({
    site_name: '',
    domain: '',
    region: 'seoul',
    platform: 'wordpress',
    plan: props.plans.length > 0 ? props.plans[0].name : '',
    months: 1,
    user_password: ''
});

const months = [
    { value: 1, label: '1개월', discount: 0 },
    { value: 3, label: '3개월', discount: 5 },
    { value: 6, label: '6개월', discount: 10 },
    { value: 12, label: '1년', discount: 20 }
];

// regions 배열 동적 생성 (국기 등은 기본값)
const regionFlagMap = {
    'seoul': '🇰🇷',
    'korea': '🇰🇷',
    'tokyo': '🇯🇵',
    'japan': '🇯🇵',
    'singapore': '🇸🇬',
    'frankfurt': '🇩🇪',
    'germany': '🇩🇪',
    'us': '🇺🇸',
    'usa': '🇺🇸',
    'newyork': '🇺🇸',
    'london': '🇬🇧',
    'uk': '🇬🇧',
    'sydney': '🇦🇺',
    'australia': '🇦🇺',
    'canada': '🇨🇦',
    'paris': '🇫🇷',
    'france': '🇫🇷',
    'hongkong': '🇭🇰',
    'hk': '🇭🇰',
    'mumbai': '🇮🇳',
    'india': '🇮🇳',
};
const regions = props.regions.map(r => ({
    value: r,
    label: r,
    flag: regionFlagMap[r.toLowerCase()] || '🌏',
    country: ''
}));

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

const selectedPlan = ref(null);

function updateSelectedPlan() {
    selectedPlan.value = plans.find(
        p => p.name === form.plan || p.id === form.plan
    );
}

// 최초 로딩 시에도 selectedPlan 세팅
updateSelectedPlan();

// form.plan이 바뀔 때마다 selectedPlan도 자동 갱신
watch(() => form.plan, updateSelectedPlan);

// 할인된 가격 계산
const getDiscountedPrice = (plan, months) => {
  const priceNum = typeof plan.price === 'number' ? plan.price : parseInt(plan.price, 10);
  const selectedMonth = months.find(m => m.value === form.months);
  const discount = selectedMonth ? selectedMonth.discount : 0;
  return Math.round(priceNum * form.months * (1 - discount / 100));
};

const passwordValid = ref(null);
const passwordCheckLoading = ref(false);
let passwordCheckTimeout = null;

watch(() => form.user_password, (val) => {
    if (passwordCheckTimeout) clearTimeout(passwordCheckTimeout);
    if (!val) {
        passwordValid.value = null;
        return;
    }
    passwordCheckLoading.value = true;
    passwordCheckTimeout = setTimeout(async () => {
        try {
            const res = await axios.post('/user/password-check', { password: val });
            passwordValid.value = res.data.valid;
        } catch (e) {
            passwordValid.value = null;
        } finally {
            passwordCheckLoading.value = false;
        }
    }, 400); // 0.4초 debounce
});

const submit = () => {
    form.post(route('server.payment.dummy'));
};

const features = props.features || [];
const featurePlan = props.featurePlan || [];
const showFeatureModal = ref(false);
function isFeatureSupported(plan, feature) {
    return featurePlan.some(fp => fp.plan_id === plan.id && fp.feature_id === feature.id);
}
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
                                        <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/50">.hostylefree.xyz</span>
                                    </div>
                                    <div v-if="form.errors.domain" class="mt-2 text-red-300 text-sm">{{ form.errors.domain }}</div>
                                </div>
                                <!-- 대시보드 로그인 비밀번호 -->
                                <div class="md:col-span-2">
                                    <label class="block text-white font-medium mb-2">대시보드 로그인 비밀번호 *</label>
                                    <input 
                                        v-model="form.user_password"
                                        type="password"
                                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:border-purple-400 focus:outline-none transition-colors"
                                        placeholder="로그인 시 사용한 비밀번호를 입력하세요"
                                        required
                                    >
                                    <div class="mt-2 text-white/60 text-sm">이 비밀번호는 <b>웹파일관리자 / DB 계정에도 사용됩니다.</b></div>
                                    <div v-if="form.errors.user_password" class="mt-2 text-red-300 text-sm">{{ form.errors.user_password }}</div>
                                    <div v-if="passwordCheckLoading" class="mt-2 text-blue-300 text-sm">비밀번호 확인 중...</div>
                                    <div v-else-if="passwordValid === true" class="mt-2 text-green-400 text-sm">비밀번호가 일치합니다.</div>
                                    <div v-else-if="passwordValid === false" class="mt-2 text-red-400 text-sm">비밀번호가 일치하지 않습니다.</div>
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
                                        'p-4 border-2 rounded-lg cursor-pointer transition-all duration-300 flex items-center gap-3',
                                        form.region === region.value 
                                            ? 'border-purple-400 bg-purple-500/20' 
                                            : 'border-white/20 bg-white/5 hover:bg-white/10'
                                    ]"
                                    @click="form.region = region.value"
                                >
                                    <span class="text-2xl">{{ region.flag }}</span>
                                    <div>
                                        <div class="text-white font-medium">{{ region.label }}</div>
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
                                        <div class="w-12 h-12 mx-auto mb-4 bg-white/10 rounded-lg flex items-center justify-center overflow-hidden">
                                            <img :src="platform.icon" :alt="platform.label" class="w-10 h-10 object-contain" />
                                        </div>
                                        <div class="text-white font-bold mb-2">{{ platform.label }}</div>
                                        <div class="text-white/60 text-sm">{{ platform.description }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4단계: 요금제 선택 -->
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 p-8">
                            <div class="flex items-start justify-between">
                                <h3 class="text-2xl font-bold text-white mb-6">4. 요금제 선택</h3>
                                <button type="button" class="ml-auto px-4 py-2 bg-purple-600 text-white rounded shadow text-sm font-semibold hover:bg-purple-700 transition" @click="showFeatureModal = true">
                                    요금제별 기능
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div 
                                    v-for="plan in plans" 
                                    :key="plan.id || plan.value"
                                    :class="[
                                        'flex flex-col items-center border-2 rounded-xl cursor-pointer transition-all duration-200 relative bg-white/5 min-h-[210px] py-4 px-2 md:px-3',
                                        form.plan === (plan.value || plan.name)
                                            ? 'border-purple-400 bg-purple-500/10'
                                            : 'border-white/20 hover:bg-white/10',
                                        'text-white',
                                        hoveredPlan === (plan.value || plan.name) ? 'scale-[1.03] shadow-lg z-10 border-purple-400' : ''
                                    ]"
                                    @click="form.plan = plan.value || plan.name; updateSelectedPlan()"
                                    @mouseover="hoveredPlan = plan.value || plan.name"
                                    @mouseleave="hoveredPlan = null"
                                    style="transition: box-shadow 0.2s, transform 0.2s;"
                                >
                                    <!-- 추천 뱃지: 카드 상단 테두리와 겹치게 -->
                                    <div v-if="plan.value === 'business' || plan.name === 'business'" class="absolute left-1/2 -translate-x-1/2 -top-8 translate-y-1/2 bg-gradient-to-r from-pink-400 to-purple-500 text-white text-[12px] font-bold px-3 py-0.5 rounded-full shadow z-20 flex items-center gap-1 border-2 border-white/30">
                                        <span>🔥</span> 추천
                                    </div>
                                    <!-- 무료 플랜 강조: 15일 무료 뱃지 카드 상단 테두리와 겹치게 -->
                                    <div v-if="plan.value === 'free' || plan.name === 'free'" class="absolute left-1/2 -translate-x-1/2 -top-8 translate-y-1/2 bg-green-600 text-white text-[12px] font-bold px-3 py-0.5 rounded-full shadow z-20 border-2 border-white/30">15일 무료</div>
                                    <div class="text-center w-full flex flex-col flex-1 justify-between">
                                        <div class="font-bold text-base mb-0.5 text-xl">
                                            <template v-if="plan.value === 'free' || plan.name === 'free'">
                                                <span class="text-green-500">무료</span>
                                            </template>
                                            <template v-else>
                                                {{ plan.label || plan.name }}
                                            </template>
                                        </div>
                                        <div class="text-[11px] mb-1 text-white">
                                            <template v-if="plan.value === 'free' || plan.name === 'free'">개인 실험/테스트, 소규모 임시 사이트에 적합</template>
                                            <template v-else-if="plan.value === 'starter' || plan.name === 'starter'">개인 블로그, 포트폴리오, 소규모 홈페이지 추천</template>
                                            <template v-else-if="plan.value === 'business' || plan.name === 'business'">중소기업, 단체, 트래픽 많은 사이트에 추천</template>
                                            <template v-else-if="plan.value === 'enterprise' || plan.name === 'enterprise'">대규모 서비스, 기업/기관, 고성능이 필요한 경우</template>
                                        </div>
                                        <!-- 금액/월 정렬 -->
                                        <div class="flex items-end justify-center mb-1 h-8">
                                            <template v-if="plan.value === 'free' || plan.name === 'free'">
                                                <span class="text-lg font-extrabold text-white">0원</span>
                                            </template>
                                            <template v-else>
                                                <span class="text-2xl font-extrabold">₩{{ Number(plan.price).toLocaleString() }}</span>
                                                <span class="ml-0.5 text-s font-semibold text-white/70 mb-0.5">/월</span>
                                            </template>
                                        </div>
                                        <div class="w-full text-[13px] mt-1 space-y-0.5 text-left">
                                            <div>디스크: <b>{{ plan.disk || plan.specs?.storage }}</b></div>
                                            <div>트래픽: <b>{{ plan.traffic || plan.specs?.traffic }}</b></div>
                                            <div>도메인: <b>{{ plan.domains || plan.specs?.domains }}</b>개</div>
                                            <div>DB: <b>{{ plan.databases || plan.specs?.databases }}</b>개</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 기존 통합 기능 표 제거 -->
                        <!-- 요금제별 기능 모달 -->
                        <Modal :show="showFeatureModal" @close="showFeatureModal = false">
                            <div class="p-1 bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 rounded-lg shadow-xl w-full max-w-full mx-auto border border-white/20 z-[100] relative">
                                <h3 class="text-base font-bold mb-2 text-white text-center">요금제별 지원 기능</h3>
                                <div class="overflow-x-auto w-full">
                                    <table class="w-full table-auto border-collapse bg-white/10 rounded-lg text-[11px]">
                                        <thead>
                                            <tr>
                                                <th class="p-1 text-purple-200 text-[11px] text-left font-semibold whitespace-nowrap">기능</th>
                                                <th v-for="plan in plans" :key="plan.id || plan.value" class="p-1 text-purple-300 font-bold text-center text-[11px] whitespace-nowrap">
                                                    {{ plan.label || plan.name }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="feature in features" :key="feature.id" class="border-t border-white/20">
                                                <td class="p-1 text-white/80 text-[11px] whitespace-nowrap">{{ feature.name }}</td>
                                                <td v-for="plan in plans" :key="plan.id || plan.value" class="p-1 text-center">
                                                    <span v-if="isFeatureSupported(plan, feature)" class="text-green-400 text-base">✔️</span>
                                                    <span v-else class="text-red-400 text-base">❌</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="mt-2 px-4 py-1 bg-gradient-to-r from-purple-700 to-blue-700 hover:from-purple-800 hover:to-blue-800 text-white rounded-lg font-semibold block mx-auto shadow transition-all duration-300 text-xs z-[110] relative focus:outline-none" @click.stop="showFeatureModal = false" @mousedown.stop tabindex="0" autofocus>닫기</button>
                            </div>
                        </Modal>

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
                    </form>
                </div>

                <!-- 사이드바: 선택된 플랜 정보 -->
                <div class="lg:w-96">
                    <div class="bg-gradient-to-br from-purple-900/60 via-blue-900/60 to-indigo-900/60 backdrop-blur-2xl rounded-2xl border border-white/30 shadow-2xl p-7 sticky top-6 flex flex-col gap-4 min-h-[480px]">
                        <h3 class="text-lg font-bold text-white mb-2 tracking-tight">6. 최종 주문서</h3>
                        <!-- 사이트 이름/도메인 표시 -->
                        <div v-if="form.site_name || form.domain" class="mb-2 px-4 py-2 bg-white/10 rounded-xl text-center flex flex-col gap-1">
                            <div v-if="form.site_name" class="text-base font-semibold text-white truncate">{{ form.site_name }}</div>
                            <div v-if="form.domain" class="text-xs text-white/70 truncate">{{ form.domain }}.hostylefree.xyz</div>
                        </div>
                        <div v-if="selectedPlan" class="flex-1 flex flex-col gap-4">
                            <!-- 요금제명/뱃지/설명 -->
                            <div class="text-center p-4 bg-white/10 rounded-xl flex flex-col items-center gap-1 relative">
                                <div class="flex items-center justify-center gap-2 mb-1">
                                    <span class="text-2xl font-extrabold" :class="selectedPlan.value === 'free' || selectedPlan.name === 'free' ? 'text-green-400' : 'text-white'">{{ selectedPlan.label || selectedPlan.name }}</span>
                                    <span v-if="selectedPlan.value === 'business' || selectedPlan.name === 'business'" class="bg-gradient-to-r from-pink-400 to-purple-500 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow border-2 border-white/20 ml-1">🔥 추천</span>
                                    <span v-if="selectedPlan.value === 'free' || selectedPlan.name === 'free'" class="bg-green-600 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow border-2 border-white/20 ml-1">15일 무료</span>
                                </div>
                                <div class="text-xs text-white/80 mb-1">
                                    <template v-if="selectedPlan.value === 'free' || selectedPlan.name === 'free'">개인 실험/테스트, 소규모 임시 사이트에 적합</template>
                                    <template v-else-if="selectedPlan.value === 'starter' || selectedPlan.name === 'starter'">개인 블로그, 포트폴리오, 소규모 홈페이지 추천</template>
                                    <template v-else-if="selectedPlan.value === 'business' || selectedPlan.name === 'business'">중소기업, 단체, 트래픽 많은 사이트에 추천</template>
                                    <template v-else-if="selectedPlan.value === 'enterprise' || selectedPlan.name === 'enterprise'">대규모 서비스, 기업/기관, 고성능이 필요한 경우</template>
                                </div>
                            </div>
                            <!-- 주요 스펙 -->
                            <div class="grid grid-cols-2 gap-2 text-sm text-white/90">
                                <div class="flex items-center gap-2 bg-white/10 rounded-lg px-3 py-2"><span class="i-lucide-hard-drive text-lg text-blue-300"></span> <b>디스크</b>: {{ selectedPlan.disk }}</div>
                                <div class="flex items-center gap-2 bg-white/10 rounded-lg px-3 py-2"><span class="i-lucide-activity text-lg text-blue-300"></span> <b>트래픽</b>: {{ selectedPlan.traffic }}</div>
                                <div class="flex items-center gap-2 bg-white/10 rounded-lg px-3 py-2"><span class="i-lucide-globe text-lg text-blue-300"></span> <b>도메인</b>: {{ selectedPlan.domains }}개</div>
                                <div class="flex items-center gap-2 bg-white/10 rounded-lg px-3 py-2"><span class="i-lucide-database text-lg text-blue-300"></span> <b>DB</b>: {{ selectedPlan.databases }}개</div>
                            </div>
                            <!-- 결제 정보 -->
                            <div class="bg-gradient-to-r from-purple-700/40 to-blue-700/40 rounded-xl p-4 flex flex-col gap-2 text-white/90 shadow-inner">
                                <div class="flex justify-between text-sm">
                                    <span>월 요금</span>
                                    <span class="font-bold">₩{{ Number(selectedPlan.price).toLocaleString() }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span>결제 기간</span>
                                    <span>{{ months.find(m => m.value === form.months)?.label }}</span>
                                </div>
                                <div v-if="months.find(m => m.value === form.months)?.discount > 0" class="flex justify-between text-green-400 text-sm items-end">
                                    <span>할인</span>
                                    <span>
                                        -{{ months.find(m => m.value === form.months)?.discount }}%
                                        <span class="text-xs text-green-200 ml-1">(₩{{ (Number(selectedPlan.price) * form.months * months.find(m => m.value === form.months)?.discount / 100).toLocaleString() }})</span>
                                    </span>
                                </div>
                                <div class="flex justify-between text-lg font-bold border-t border-white/20 pt-2 mt-2">
                                    <span>총 결제 금액</span>
                                    <span class="text-yellow-300">₩{{ getDiscountedPrice(selectedPlan, months).toLocaleString() }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- 서버생성/결제 버튼 (카드 하단, 카드와 동일한 너비/스타일) -->
                        <button 
                            type="button"
                            @click="submit"
                            class="mt-4 w-full bg-gradient-to-r from-purple-500/80 to-blue-500/80 hover:from-purple-600 hover:to-blue-600 text-white font-bold py-4 rounded-lg text-lg transition-all duration-300 transform hover:scale-105 shadow-xl"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">처리중...</span>
                            <span v-else>서버생성 / 결제</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template> 