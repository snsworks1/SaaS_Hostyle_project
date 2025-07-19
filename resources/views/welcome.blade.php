<!DOCTYPE html>
<html lang="ko" class="dark">
<head>
  <!-- Alpine.js -->
  <script src="https://unpkg.com/alpinejs" defer></script>

  <!-- Meta 기본 -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#1e1f25" />

  <!-- SEO -->
  <title>Hostyle – 홈페이지 제작 SaaS 호스타일</title>
  <meta name="description" content="카페, 병원, 소상공인을 위한 쉽고 빠른 홈페이지 생성 플랫폼. 지금 바로 시작하세요!">
  <meta name="keywords" content="홈페이지 제작, WordPress SaaS, 병원 홈페이지, 카페 사이트, 자동설치 호스팅">
  <meta name="author" content="S&S Works">

  <!-- Open Graph (SNS 공유) -->
  <meta property="og:title" content="Hostyle – 1개월 1000원! 지금 시작하세요">
  <meta property="og:description" content="누구나 쉽게 시작하는 WordPress SaaS. 카페, 병원, 소상공인 전용 솔루션.">
  <meta property="og:image" content="https://hostyle.me/assets/og-image2.jpg">
  <meta property="og:url" content="https://hostyle.me">
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">

  <!-- Naver 인증 -->
  <meta name="naver-site-verification" content="28b6a23100e916ab0caa77d70504b95b3e48cf5e" />

  <!-- 파비콘 / 아이콘 -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/IconOnly_Transparent.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/IconOnly_Transparent.png') }}">

  <!-- 폰트 / 아이콘 -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />



  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Noto Sans KR"', 'sans-serif'],
          }
        }
      }
    };
  </script>

  <!-- 사용자 정의 스타일 -->
  <style>
    body {
      font-family: 'Noto Sans KR', sans-serif;
      background-color: #1e1f25;
      color: white;
    }
    .slider img {
      transition: opacity 1s ease-in-out;
    }
      [x-cloak] { display: none !important; }
  </style>
</head>

<body class="bg-zinc-900 text-white overflow-x-hidden">
    <main class="max-w-screen overflow-x-hidden">




<!-- Header -->
<!-- Header -->
<header class="bg-zinc-900/90 backdrop-blur border-b border-zinc-800 sticky top-0 z-50 shadow-sm">
  <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center px-4 py-3 md:px-6 md:py-4 gap-y-3">

    <!-- 로고 -->
    <div class="flex-shrink-0 w-full md:w-auto flex items-center justify-center md:justify-start">
      <img src="{{ asset('images/logo.webp') }}" alt="Hostyle Logo" class="w-48 h-auto mx-auto md:mx-0 drop-shadow" />
    </div>

    <!-- 네비게이션 -->
    <nav class="flex flex-wrap justify-center md:justify-end items-center gap-x-3 gap-y-2 w-full md:w-auto text-sm font-medium">
      <a href="https://snsworks.co.kr" target="_blank"
         class="text-zinc-400 hover:text-blue-400 transition px-3 py-1 rounded-md">
        S&SWorks 홈페이지
      </a>

      <a href="https://s-organization-887.gitbook.io/hostyle-web/" target="_blank"
         class="text-zinc-400 hover:text-blue-400 transition px-3 py-1 rounded-md">
        📘 가이드북
      </a>

      <a href="{{ route('blog.index') }}" target="_blank"
         class="text-zinc-400 hover:text-blue-400 transition px-3 py-1 rounded-md">
        블로그
      </a>

  
        <a href="{{ route('dashboard') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-md transition shadow-sm">
          Dashboard 바로가기
        </a>
 
        <a href="{{ route('login') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-md transition shadow-sm">
          로그인
        </a>
    
    </nav>
  </div>
</header>




<!-- Hero Section -->
<section class="bg-[#1e1f25] text-white pt-28 pb-20 px-6 relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-14 items-center">

    <!-- 텍스트 -->
    <div class="space-y-6 md:pr-10 animate-fade-in-up delay-100">
      <h1 class="text-4xl md:text-5xl font-extrabold leading-snug md:leading-normal">
  <span class="animate-pulse text-indigo-400 font-black">1</span>분 만에 구축되는<br>
  <span class="text-indigo-400 block">서버 & 홈페이지 플랫폼</span>
</h1>
      <p class="text-zinc-300 text-base md:text-lg leading-relaxed">
        클릭 한 번으로 서버와 홈페이지가 자동 설치됩니다.<br>
        병원, 카페, 학원 등 실사용자 맞춤형 솔루션을 제공합니다.
      </p>
      <div class="flex flex-col sm:flex-row gap-4">
        <a href="/login"
           class="bg-indigo-600 hover:bg-indigo-700 hover:scale-105 hover:ring-2 hover:ring-indigo-400 transition-all text-white px-6 py-3 rounded-lg text-base font-semibold shadow">
          ₩1,000으로 시작하기
        </a>
        <a href="https://s-organization-887.gitbook.io/hostyle-web/" target="_blank"
           class="border border-indigo-400 text-indigo-400 hover:bg-indigo-600 hover:text-white hover:scale-105 transition-all px-6 py-3 rounded-lg text-base font-semibold shadow">
          사용 가이드 보기
        </a>
      </div>
    </div>

    <!-- 이미지 -->
<!-- 이미지 -->
<div class="relative flex justify-center md:justify-end group animate-fade-in-up delay-200">

  <!-- 💡 더 강하고 선명한 Glow 라이트 -->
  <div class="absolute -top-20 -left-20 w-[380px] h-[380px] bg-indigo-400/40 rounded-full blur-[120px] opacity-90 group-hover:scale-110 group-hover:opacity-100 transition-all duration-700 z-0 pointer-events-none"></div>

  <!-- 이미지 -->
  <img src="/images/topimg01.webp"
       loading="lazy"
       alt="Hostyle 서비스 자동 구축 예시"
       class="relative z-10 rounded-2xl shadow-2xl max-w-[620px] w-full transition-transform duration-500 hover:scale-105">
</div>


  <!-- 빛나는 배경 효과 -->
  <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-indigo-500 rounded-full blur-[120px] opacity-10 pointer-events-none"></div>
</section>


<!-- 신뢰 지표 -->
 <!-- 신뢰 지표 -->
<section class="bg-[#222328] py-16">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-3 gap-8 text-center text-white">
    
    <!-- 카드 1: 고객 만족도 -->
    <div class="relative group overflow-hidden rounded-xl border border-zinc-700 transition-transform duration-300 hover:scale-105 shadow-inner bg-zinc-900/80">
      <!-- Glow & Shadow -->
      <div class="absolute inset-0 bg-blue-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-xl pointer-events-none z-0 shadow-[0_0_50px_10px_rgba(96,165,250,0.25)] group-hover:shadow-[0_0_80px_20px_rgba(96,165,250,0.35)]"></div>
      <div class="relative z-10 p-6">
        <p class="text-4xl sm:text-5xl font-extrabold text-blue-400 mb-2 animate-fade-in-up">97%</p>
        <p class="text-sm text-zinc-400">고객 만족도</p>
      </div>
    </div>

    <!-- 카드 2: 설치 시간 -->
    <div class="relative group overflow-hidden rounded-xl border border-zinc-700 transition-transform duration-300 hover:scale-105 shadow-inner bg-zinc-900/80">
      <!-- Glow & Shadow -->
      <div class="absolute inset-0 bg-purple-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-xl pointer-events-none z-0 shadow-[0_0_50px_10px_rgba(192,132,252,0.25)] group-hover:shadow-[0_0_80px_20px_rgba(192,132,252,0.35)]"></div>
      <div class="relative z-10 p-6">
        <p class="text-4xl sm:text-5xl font-extrabold text-purple-400 mb-2 animate-fade-in-up">1분</p>
        <p class="text-sm text-zinc-400">평균 설치 소요시간</p>
      </div>
    </div>

    <!-- 카드 3: 유저 수 -->
    <div class="relative group overflow-hidden rounded-xl border border-zinc-700 transition-transform duration-300 hover:scale-105 shadow-inner bg-zinc-900/80">
      <!-- Glow & Shadow -->
      <div class="absolute inset-0 bg-green-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-xl pointer-events-none z-0 shadow-[0_0_50px_10px_rgba(74,222,128,0.25)] group-hover:shadow-[0_0_80px_20px_rgba(74,222,128,0.35)]"></div>
      <div class="relative z-10 p-6">
        <p class="text-4xl sm:text-5xl font-extrabold text-green-400 mb-2 animate-fade-in-up">100+</p>
        <p class="text-sm text-zinc-400">오픈 후, 많은 유저 가입 중</p>
      </div>
    </div>

  </div>
</section>



<!-- Features -->
<!-- Features Section -->
<section class="bg-gradient-to-b from-zinc-900 to-[#1e1f25] py-20 px-6 text-white">
  <div class="max-w-7xl mx-auto text-center mb-14">
    <h2 class="text-3xl md:text-4xl font-bold">왜 Hostyle인가?</h2>
    <p class="text-zinc-400 mt-2 text-sm">설정 없이, 걱정 없이 시작하는 홈페이지</p>
  </div>

  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">

    <!-- 카드 반복 -->
    <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
      <!-- Glow 효과 -->
      <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
      <!-- 카드 내용 -->
      <div class="relative z-10">
        <div class="text-blue-400 text-3xl mb-4 group-hover:scale-110 transition-transform"><i class="fas fa-magic"></i></div>
        <h3 class="font-semibold text-lg mb-2">클릭 한 번으로 자동 설치</h3>
        <p class="text-sm text-zinc-300">복잡한 FTP, DB 설치 없이 자동 구축</p>
      </div>
    </div>

    <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
      <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
      <div class="relative z-10">
        <div class="text-sky-400 text-3xl mb-4 group-hover:scale-110 transition-transform"><i class="fab fa-wordpress"></i></div>
        <h3 class="font-semibold text-lg mb-2">WordPress 최적화</h3>
        <p class="text-sm text-zinc-300">전용 템플릿 + 관리자 패널 통합 제공</p>
      </div>
    </div>

    <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
      <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
      <div class="relative z-10">
        <div class="text-red-400 text-3xl mb-4 group-hover:scale-110 transition-transform"><i class="fas fa-shield-alt"></i></div>
        <h3 class="font-semibold text-lg mb-2">강력한 보안 & DDoS 방어</h3>
        <p class="text-sm text-zinc-300">Cloudflare 연동 + L7/4 레벨 방어 제공</p>
      </div>
    </div>

    <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
      <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
      <div class="relative z-10">
        <div class="text-yellow-400 text-3xl mb-4 group-hover:scale-110 transition-transform"><i class="fas fa-clipboard-list"></i></div>
        <h3 class="font-semibold text-lg mb-2">맞춤형 가이드북</h3>
        <p class="text-sm text-zinc-300">처음 시작하는 분도 쉽게 따라할 수 있어요</p>
      </div>
    </div>

    <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
      <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
      <div class="relative z-10">
        <div class="text-pink-400 text-3xl mb-4 group-hover:scale-110 transition-transform"><i class="fas fa-box-open"></i></div>
        <h3 class="font-semibold text-lg mb-2">부담 없는 요금제</h3>
        <p class="text-sm text-zinc-300">첫 달 1,000원 제험 사용</p>
      </div>
    </div>

    <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
      <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
      <div class="relative z-10">
        <div class="text-green-400 text-3xl mb-4 group-hover:scale-110 transition-transform"><i class="fas fa-clock"></i></div>
        <h3 class="font-semibold text-lg mb-2">1분 이내 자동 구축</h3>
        <p class="text-sm text-zinc-300">결제 후 바로 접속 가능한 빠른 설치</p>
      </div>
    </div>

  </div>
</section>


<!-- <section 
    x-data="coverflowSlider({ themes: {{ json_encode($themes) }} })"
    x-init="setInterval(() => next(), 4000)"
    class="py-16 bg-[#222328] text-white"
>
  <div class="relative w-full px-4 py-12">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-white mb-10">✨ Pro 테마 갤러리</h2>
    <p class="text-center text-sm text-gray-300 mb-10">테마 카드를 클릭해보세요</p>

    
    <div class="relative h-[440px] flex items-center justify-center">
     
<button
  @click="prev()"
  class="absolute top-1/2 -translate-y-1/2 left-[10%] z-50 text-white bg-zinc-700 hover:bg-zinc-600 rounded-full w-10 h-10 flex items-center justify-center shadow-md"
>
  <i class="fa-solid fa-chevron-left"></i>
</button>

      
<template x-for="(theme, index) in themes" :key="index">
  <div
    class="absolute w-72 sm:w-80 h-[440px] rounded-2xl overflow-hidden transition-all duration-500 cursor-pointer
           hover:scale-[1.03] shadow-[0_0_20px_#3b82f680]"
    :class="{
      'ring-2 ring-blue-500 shadow-blue-500/30 scale-[1.04] z-20': index === selectedIndex
    }"
    :style="getStyle(index)"
    @click="
      selectedIndex = index;
      openModal(theme.screenshots);
    "
  >
    <div class="relative w-full h-full">
   
      <img
        :src="'/storage/' + (theme.screenshots[0] ?? 'no-image.png')"
        class="w-full h-full object-cover rounded-2xl"
      />

     
      <div class="absolute bottom-0 w-full bg-black/40 backdrop-blur-sm text-white text-center text-sm py-2">
        <span x-text="theme.name" class="font-medium"></span>
      </div>
    </div>
  </div>
</template>

  
    
    
<button
  @click="next()"
  class="absolute top-1/2 -translate-y-1/2 right-[10%] z-50 text-white bg-zinc-700 hover:bg-zinc-600 rounded-full w-10 h-10 flex items-center justify-center shadow-md"
>
  <i class="fa-solid fa-chevron-right"></i>
</button>
    </div>

  
    <div class="flex justify-center mt-8 space-x-2">
      <template x-for="(theme, index) in themes" :key="index">
        <button
          class="w-3 h-3 rounded-full"
          :class="{
            'bg-white': index === current,
            'bg-white/30': index !== current
          }"
          @click="current = index"
        ></button>
      </template>
    </div>

   
    <div x-show="showModal" x-cloak class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
      <div class="relative bg-white max-w-4xl w-full rounded-xl shadow-lg">
       
        <button
  @click="showModal = false"
  class="absolute top-4 right-4 text-white bg-black/60 hover:bg-red-600 hover:text-white rounded-full w-10 h-10 flex items-center justify-center shadow-md transition"
  title="닫기"
>
  <i class="fa-solid fa-xmark text-xl"></i>
</button>

       
        <div class="flex justify-center items-center h-[460px]">
          <img :src="'/storage/' + currentImage" class="max-h-full object-contain rounded-lg" />
        </div>

      
        <div class="flex items-center justify-between gap-2 p-4">
          <button @click="prevImage()" class="text-black hover:text-blue-500">
            <i class="fa-solid fa-chevron-left text-xl"></i>
          </button>

          <div class="flex overflow-x-auto gap-2">
            <template x-for="(thumb, i) in modalImages" :key="i">
              <img
                :src="'/storage/' + thumb"
                class="w-20 h-16 object-cover border-2 rounded cursor-pointer"
                :class="{ 'border-blue-500': thumb === currentImage }"
                @click="currentImage = thumb"
              />
            </template>
          </div>

          <button @click="nextImage()" class="text-black hover:text-blue-500">
            <i class="fa-solid fa-chevron-right text-xl"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</section> -->

<!-- ✅ AlpineJS Logic -->
<!-- <script>
function coverflowSlider({ themes }) {
  return {
    themes,
    current: 0,
        selectedIndex: null, // ✅ 추가

    showModal: false,
    modalImages: [],
    currentImage: '',

    getStyle(index) {
      const offset = (index - this.current + this.themes.length) % this.themes.length;
      const baseZ = 30;
      const positions = {
        0: 'z-index: ' + (baseZ + 3) + '; transform: scale(1.1) translateX(0px);',
        1: 'z-index: ' + (baseZ + 2) + '; transform: scale(0.9) translateX(-180px) rotateY(10deg); opacity: 0.8;',
        [-1]: 'z-index: ' + (baseZ + 2) + '; transform: scale(0.9) translateX(180px) rotateY(-10deg); opacity: 0.8;',
        2: 'z-index: ' + (baseZ + 1) + '; transform: scale(0.8) translateX(-320px) rotateY(20deg); opacity: 0.5;',
        [-2]: 'z-index: ' + (baseZ + 1) + '; transform: scale(0.8) translateX(320px) rotateY(-20deg); opacity: 0.5;'
      };
      const pos = index === this.current ? 0 :
                  index === (this.current + 1) % this.themes.length ? 1 :
                  index === (this.current - 1 + this.themes.length) % this.themes.length ? -1 :
                  index === (this.current + 2) % this.themes.length ? 2 :
                  index === (this.current - 2 + this.themes.length) % this.themes.length ? -2 : null;
      return positions[pos] || 'z-index: 0; opacity: 0; pointer-events: none;';
    },

    openModal(images) {
      this.modalImages = images;
      this.currentImage = images[0];
      this.showModal = true;
    },

    nextImage() {
      const idx = this.modalImages.indexOf(this.currentImage);
      if (idx < this.modalImages.length - 1) this.currentImage = this.modalImages[idx + 1];
    },

    prevImage() {
      const idx = this.modalImages.indexOf(this.currentImage);
      if (idx > 0) this.currentImage = this.modalImages[idx - 1];
    },

    next() {
      this.current = (this.current + 1) % this.themes.length;
    },

    prev() {
      this.current = (this.current - 1 + this.themes.length) % this.themes.length;
    },
  }
}
</script> -->





<!-- ✅ 더 넓은 슬라이더: 브라우저 전체 폭 사용 -->
<!-- ✅ 더 넓은 슬라이더: 브라우저 전체 폭 사용 -->
<!-- 카드 섹션 -->
<section class="bg-gradient-to-b from-zinc-900 to-[#1e1f25] py-20 px-4">
  <div class="max-w-7xl mx-auto grid md:grid-cols-12 gap-12 items-center">

    <!-- 좌측 카드 그룹 -->
    <div class="md:col-span-5 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-y-10">

      <!-- 카드 1 -->
      <div class="relative bg-zinc-800 p-6 min-h-[160px] rounded-xl shadow-xl text-white overflow-hidden group transition duration-300 hover:shadow-indigo-500/30">
        <!-- 고정 Glow -->
        <div class="absolute -top-8 -left-8 w-36 h-36 bg-blue-400/20 blur-2xl rounded-full z-0 pointer-events-none"></div>
        <!-- Hover 퍼지는 퍼플 Glow -->
        <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-xl z-0 pointer-events-none"></div>

        <!-- 카드 내용 -->
        <div class="relative z-10">
          <div class="text-blue-400 text-4xl mb-4 group-hover:scale-110 transition-transform"><i class="fas fa-bullhorn"></i></div>
          <h3 class="font-semibold text-lg mb-2">다양한 업종 대응</h3>
          <p class="text-sm text-zinc-300">병원, 식당, 학원, 커뮤니티 등 맞춤형 솔루션</p>
        </div>
      </div>

      <!-- 카드 2 -->
      <div class="relative bg-zinc-800 p-6 min-h-[160px] rounded-xl shadow-xl text-white overflow-hidden group transition duration-300 hover:shadow-indigo-500/30">
        <div class="absolute -top-8 -right-8 w-36 h-36 bg-pink-400/20 blur-2xl rounded-full z-0 pointer-events-none"></div>
        <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-xl z-0 pointer-events-none"></div>
        <div class="relative z-10">
          <div class="text-pink-400 text-4xl mb-4 group-hover:scale-110 transition-transform"><i class="fas fa-mouse-pointer"></i></div>
          <h3 class="font-semibold text-lg mb-2">1-click 설치</h3>
          <p class="text-sm text-zinc-300">WordPress 클릭 한 번으로 설치 완료</p>
        </div>
      </div>

      <!-- 카드 3 -->
      <div class="relative bg-zinc-800 p-6 min-h-[160px] rounded-xl shadow-xl text-white overflow-hidden group transition duration-300 hover:shadow-indigo-500/30">
        <div class="absolute -bottom-8 -left-8 w-36 h-36 bg-sky-400/20 blur-2xl rounded-full z-0 pointer-events-none"></div>
        <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-xl z-0 pointer-events-none"></div>
        <div class="relative z-10">
          <div class="text-sky-400 text-4xl mb-4 group-hover:scale-110 transition-transform"><i class="fab fa-wordpress"></i></div>
          <h3 class="font-semibold text-lg mb-2">WP 템플릿 무료 제공</h3>
          <p class="text-sm text-zinc-300">즉시 사용 가능한 맞춤형 템플릿</p>
        </div>
      </div>

      <!-- 카드 4 -->
      <div class="relative bg-zinc-800 p-6 min-h-[160px] rounded-xl shadow-xl text-white overflow-hidden group transition duration-300 hover:shadow-indigo-500/30">
        <div class="absolute -bottom-8 -right-8 w-36 h-36 bg-green-400/20 blur-2xl rounded-full z-0 pointer-events-none"></div>
        <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-xl z-0 pointer-events-none"></div>
        <div class="relative z-10">
          <div class="text-green-400 text-4xl mb-4 group-hover:scale-110 transition-transform"><i class="fas fa-clock"></i></div>
          <h3 class="font-semibold text-lg mb-2">1분 내 구축</h3>
          <p class="text-sm text-zinc-300">결제 후 바로 접속 가능한 빠른 설치</p>
        </div>
      </div>

    </div>

    <!-- ✅ 우측 슬라이더 + 라이트 효과 -->
    <div class="md:col-span-7 relative">

      <div class="relative w-full h-[360px] md:h-[480px] lg:h-[560px] rounded-2xl overflow-hidden shadow-xl bg-zinc-700">

        <!-- 💡 Glow 효과 -->
        <div class="absolute -top-24 -left-24 w-[440px] h-[440px] bg-indigo-400/30 rounded-full blur-[120px] opacity-80 z-0 pointer-events-none"></div>

        <!-- 슬라이드 이미지들 -->
  <div class="slider relative w-full h-[360px] md:h-[480px] lg:h-[560px] rounded-2xl overflow-hidden shadow-xl bg-zinc-700">
    <img loading="lazy" src="/images/simg01.webp" alt="슬라이드1" class="absolute inset-0 w-full h-full object-cover z-10 transition duration-1000 ease-in-out opacity-100">
    <img loading="lazy" src="/images/simg02.webp" alt="슬라이드2" class="absolute inset-0 w-full h-full object-cover z-0 transition duration-1000 ease-in-out opacity-0">
    <img loading="lazy" src="/images/simg03.webp" alt="슬라이드3" class="absolute inset-0 w-full h-full object-cover z-0 transition duration-1000 ease-in-out opacity-0">
        <img loading="lazy" src="/images/simg04.webp" alt="슬라이드4" class="absolute inset-0 w-full h-full object-cover z-0 transition duration-1000 ease-in-out opacity-0">

</div>
        <!-- 안내 문구 -->

      </div>

    </div>
  </div>
</section>



<style>
.slide-img {
  @apply absolute inset-0 w-full h-full object-cover transition-all duration-1000 ease-in-out scale-100 opacity-0 z-0;
}
.slide-img.active {
  @apply opacity-100 z-10 scale-100;
}
</style>

<script>
  // 슬라이더 로직 개선
 const slides = document.querySelectorAll('.slider img');
let current = 0;

setInterval(() => {
  slides.forEach((img, i) => {
    img.style.opacity = '0';
    img.style.zIndex = '0';
  });
  slides[current].style.opacity = '1';
  slides[current].style.zIndex = '10';

  current = (current + 1) % slides.length;
}, 3000);
</script>





<!-- Infra -->
<!-- Infra -->
<!-- ✅ 인프라 (마케팅 강화) -->
<section id="infra" class="bg-[#222328] py-28 px-6 relative overflow-hidden">
  <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">

    <!-- 좌측 이미지 + 안내 -->
    <div class="relative flex justify-center">
      <div class="absolute -inset-4 rounded-2xl bg-gradient-to-tr from-indigo-500/30 to-transparent blur-2xl animate-pulse"></div>
      <div class="relative">
        <img src="{{ asset('images/infra01.webp') }}"
             alt="서버 인프라 이미지"
             class="relative rounded-2xl shadow-2xl w-full max-w-[520px] ring-1 ring-zinc-700" />
 
      </div>
    </div>

    <!-- 우측 텍스트 -->
    <div>
      <!-- ✅ 상단 마케팅 문구 -->
      <p class="text-sm font-semibold uppercase tracking-wider text-indigo-400 mb-2">왜 많은 고객이 Hostyle을 선택할까요?</p>

      <h2 class="text-4xl md:text-5xl font-bold mb-10 text-white leading-snug tracking-tight">
        <span class="text-indigo-400">고성능 서버</span> 기반 인프라
      </h2>

      <div class="space-y-5">
  <!-- 반복 구조 시작 -->
  <div class="flex items-center gap-4 bg-[#2a2b30] p-5 rounded-lg shadow hover:shadow-indigo-500/10 transition">
    <div class="text-indigo-400 text-2xl"><i class="fas fa-rocket"></i></div>
    <p class="text-base text-zinc-100 font-medium leading-relaxed">
      <span class="text-indigo-300 font-semibold">SSD 초고속 저장소</span> + 최신 세대 CPU로 <strong class="text-white font-bold">성능 보장</strong>
    </p>
  </div>

  <div class="flex items-center gap-4 bg-[#2a2b30] p-5 rounded-lg shadow hover:shadow-indigo-500/10 transition">
    <div class="text-indigo-400 text-2xl"><i class="fas fa-shield-alt"></i></div>
    <p class="text-base text-zinc-100 font-medium leading-relaxed">
      <strong class="text-white font-bold">보안 정책 + 자동 백업</strong>으로 중요한 <span class="text-indigo-300 font-semibold">데이터 완벽 보호</span>
    </p>
  </div>

  <div class="flex items-center gap-4 bg-[#2a2b30] p-5 rounded-lg shadow hover:shadow-indigo-500/10 transition">
    <div class="text-indigo-400 text-2xl"><i class="fas fa-cloud"></i></div>
    <p class="text-base text-zinc-100 font-medium leading-relaxed">
      <span class="text-indigo-300 font-semibold">Cloudflare 연동</span>으로 <strong class="text-white font-bold">DDoS 방어 + 글로벌 속도 최적화</strong>
    </p>
  </div>

  <div class="flex items-center gap-4 bg-[#2a2b30] p-5 rounded-lg shadow hover:shadow-indigo-500/10 transition">
    <div class="text-indigo-400 text-2xl"><i class="fas fa-globe-asia"></i></div>
    <p class="text-base text-zinc-100 font-medium leading-relaxed">
      <span class="text-indigo-300 font-semibold">글로벌 DNS</span>로 빠르고 안정적인 <strong class="text-white font-bold">접속 경험</strong> 제공
    </p>
  </div>

  <div class="flex items-center gap-4 bg-[#2a2b30] p-5 rounded-lg shadow hover:shadow-indigo-500/10 transition">
    <div class="text-indigo-400 text-2xl"><i class="fas fa-user-secret"></i></div>
    <p class="text-base text-zinc-100 font-medium leading-relaxed">
      <span class="text-indigo-300 font-semibold">해외 서버</span>를 통한 <strong class="text-white font-bold">자유로운 운영 및 익명성 보장</strong>
    </p>
  </div>
</div>

      <!-- ✅ CTA 버튼 -->
      <div class="mt-10">
        <a href="/login" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-base px-6 py-3 rounded-lg shadow transition">
          지금 ₩1,000으로 시작하기 →
        </a>
        <p class="text-xs text-zinc-400 mt-2 ml-1">지금 가입하면 템플릿 + 서버 설치 모두 자동 진행됩니다.</p>
      </div>
    </div>

  </div>
</section>





<!-- Detailed Screenshots -->
<!-- 1280x720 사이즈 권장-->
<section id="images" class="bg-[#1e1f25] py-24 px-6">
  <div class="max-w-7xl mx-auto space-y-28">

    <!-- 사용자 대시보드 -->
    <div class="grid md:grid-cols-2 gap-12 items-center relative group">
      <!-- 퍼플 라이트 -->
      <div class="absolute -top-24 -left-24 w-[480px] h-[480px] bg-indigo-400/50 blur-[130px] rounded-full z-0 group-hover:opacity-100 opacity-70 transition duration-500 pointer-events-none"></div>

      <!-- 이미지 -->
      <div class="relative z-10 rounded-2xl shadow-2xl transition duration-500 group-hover:scale-[1.02]">
        <img src="/images/sector01.webp" alt="대시보드 이미지"
             class="w-full h-[360px] object-cover rounded-2xl">
      </div>

      <!-- 텍스트 -->
      <div class="text-white space-y-4 z-10">
        <h3 class="text-3xl font-extrabold tracking-tight">📊 직관적인 사용자 대시보드</h3>
        <p class="text-base text-zinc-300 leading-relaxed">
          <strong class="text-indigo-400">남은 기간 / 상태 / 도메인</strong>까지 한눈에 파악<br>
          복잡한 메뉴 없이 누구나 쉽게 사용하는 <strong class="text-white font-bold">심플한 UI</strong>
        </p>
      </div>
    </div>

    <!-- 결제 수단 -->
    <div class="grid md:grid-cols-2 gap-12 items-center relative group">
      <!-- 퍼플 라이트 -->
      <div class="absolute -top-24 -right-24 w-[480px] h-[480px] bg-indigo-400/50 blur-[130px] rounded-full z-0 group-hover:opacity-100 opacity-70 transition duration-500 pointer-events-none"></div>

      <!-- 텍스트 -->
      <div class="text-white space-y-4 order-2 md:order-1 z-10">
        <h3 class="text-3xl font-extrabold tracking-tight">💳 다양한 결제수단 완벽 지원</h3>
        <p class="text-base text-zinc-300 leading-relaxed">
          <span class="text-indigo-400">카카오페이 / 토스 / 네이버페이 / 신용카드</span><br>
          결제에 걸리는 시간은 단 <strong class="text-white font-bold">3초!</strong> 빠르고 간편한 정기 결제
        </p>
      </div>

      <!-- 이미지 -->
      <div class="relative z-10 rounded-2xl shadow-2xl transition duration-500 group-hover:scale-[1.02] order-1 md:order-2">
        <img src="/images/sector022.webp" alt="결제 이미지"
             class="w-full h-[360px] object-cover rounded-2xl">
      </div>
    </div>

    <!-- cPanel 관리 -->
    <div class="grid md:grid-cols-2 gap-12 items-center relative group">
      <!-- 퍼플 라이트 -->
      <div class="absolute -top-24 -left-24 w-[480px] h-[480px] bg-indigo-400/50 blur-[130px] rounded-full z-0 group-hover:opacity-100 opacity-70 transition duration-500 pointer-events-none"></div>

      <!-- 이미지 -->
      <div class="relative z-10 rounded-2xl shadow-2xl transition duration-500 group-hover:scale-[1.02]">
        <img src="/images/sector03.webp" alt="cPanel 이미지"
             class="w-full h-[360px] object-cover rounded-2xl">
      </div>

      <!-- 텍스트 -->
      <div class="text-white space-y-4 z-10">
        <h3 class="text-3xl font-extrabold tracking-tight">⚙️ 전문가 없이도 가능한 서버 관리</h3>
        <p class="text-base text-zinc-300 leading-relaxed">
          DNS, 데이터베이스, FTP 등 설정을 <strong class="text-indigo-400">1클릭으로</strong> 설정 가능<br>
          <span class="text-white font-bold">cPanel</span> 기반으로 서버 지식이 없어도 걱정 없음
        </p>
      </div>
    </div>

    <!-- 하단 CTA -->
    <div class="text-center mt-16">
      <h4 class="text-white text-xl font-semibold mb-4">처음이신가요?</h4>
      <a href="/login" class="inline-block bg-pink-600 hover:bg-pink-700 text-white font-semibold px-8 py-3 rounded-full text-lg shadow-lg transition">
        지금 ₩1,000으로 시작하기 →
      </a>
    </div>

  </div>
</section>





<!-- Card Example -->
<section class="bg-[#222328] py-24 px-6">
  <div class="max-w-7xl mx-auto">
    <h2 class="text-4xl font-bold text-white text-center mb-14 tracking-tight">고객 제공 도구</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

      <!-- 카드 1 -->
      <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
        <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
        <div class="relative z-10 text-center">
          <div class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-500/10 text-indigo-400 text-2xl mb-4 mx-auto">
            <i class="fas fa-book-open"></i>
          </div>
          <h3 class="text-white font-semibold text-lg mb-2">서비스 설명서</h3>
          <p class="text-sm text-zinc-400">웹서버 셋팅 & 운영 설명서 제공</p>
        </div>
      </div>

      <!-- 카드 2 -->
      <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
        <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
        <div class="relative z-10 text-center">
          <div class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-500/10 text-indigo-400 text-2xl mb-4 mx-auto">
            <i class="fas fa-database"></i>
          </div>
          <h3 class="text-white font-semibold text-lg mb-2">데이터베이스 제공</h3>
          <p class="text-sm text-zinc-400">MySQL 및 phpMyAdmin 지원</p>
        </div>
      </div>

      <!-- 카드 3 -->
      <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
        <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
        <div class="relative z-10 text-center">
          <div class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-500/10 text-indigo-400 text-2xl mb-4 mx-auto">
            <i class="fas fa-chart-line"></i>
          </div>
          <h3 class="text-white font-semibold text-lg mb-2">서버 모니터링</h3>
          <p class="text-sm text-zinc-400">메인서버 상태 실시간 확인</p>
        </div>
      </div>

      <!-- 카드 4 -->
      <div class="relative bg-zinc-800 rounded-2xl p-6 shadow-xl border border-zinc-700 group overflow-hidden transition-all duration-300 hover:shadow-indigo-500/30">
        <div class="absolute inset-0 bg-indigo-400/10 blur-[60px] scale-75 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 rounded-2xl z-0 pointer-events-none"></div>
        <div class="relative z-10 text-center">
          <div class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-500/10 text-indigo-400 text-2xl mb-4 mx-auto">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3 class="text-white font-semibold text-lg mb-2">DDoS 보안 제공</h3>
          <p class="text-sm text-zinc-400">L3/4 + Cloudflare L7 보호 지원</p>
        </div>
      </div>

    </div>
  </div>
</section>






<!-- Plans -->
<section id="plans" class="bg-[#1e1f25] py-24 px-6">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-white mb-4 tracking-tight">요금제 플랜</h2>
    <p class="text-zinc-400 mb-12 text-sm">비즈니스 성장에 맞게 유연하게 선택하세요</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
      
      <!-- Basic 플랜 -->
      <div class="relative bg-gradient-to-br from-zinc-900 to-zinc-800 border border-zinc-700 text-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
        <!-- 할인 배지 -->
        <span class="absolute -top-4 left-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">첫 달 ₩1,000</span>

        <h3 class="text-2xl font-bold mb-3">Basic 플랜</h3>
        <p class="text-zinc-400 text-sm line-through">₩29,000 / 월</p>
        <p class="text-indigo-400 font-bold text-2xl mb-6">₩1,000 <span class="text-sm text-zinc-400">/ 첫 달</span></p>

          <ul class="space-y-3 text-sm text-zinc-300 text-left">
            <li class="flex items-center gap-2"><i class="fas fa-hdd text-indigo-400"></i> 5GB SSD 저장공간</li>
            <li class="flex items-center gap-2"><i class="fas fa-tachograph-digital text-indigo-400"></i> 월 30GB 트래픽</li>
            <li class="flex items-center gap-2"><i class="fas fa-globe text-indigo-400"></i> 무료 도메인 제공</li>
            <li class="flex items-center gap-2"><i class="fab fa-wordpress text-indigo-400"></i> WordPress 자동설치</li>
            <li class="flex items-center gap-2"><i class="fas fa-database text-indigo-400"></i> DB 1개 생성 가능</li>
            <li class="flex items-center gap-2"><i class="fas fa-globe text-indigo-400"></i> 도메인 1개 연결 가능</li>
            <li class="flex items-center gap-2"><i class="fas fa-palette text-indigo-400"></i> 템플릿 기본 제공</li>
            <li class="flex items-center gap-2"><i class="fas fa-shield-alt text-indigo-400"></i> 보안 및 캐시 최적화</li>
            <li class="flex items-center gap-2"><i class="fas fa-shield-halved text-indigo-400"></i> DDoS 고급 보호</li>
          </ul>
      </div>

      <!-- Pro 플랜 -->
      <div class="relative bg-gradient-to-br from-indigo-600 to-purple-700 p-8 rounded-2xl shadow-2xl text-white transform hover:-translate-y-1 hover:shadow-indigo-800/30 transition-all duration-300">
        <!-- 추천 배지 -->
        <span class="absolute -top-4 right-4 bg-yellow-400 text-black text-xs font-bold px-3 py-1 rounded-full shadow">추천</span>

        <h3 class="text-2xl font-bold mb-3">Pro 플랜</h3>
        <p class="text-white font-bold text-xl mb-6">₩59,000 / 월</p>
        
        <ul class="space-y-3 text-sm text-white/90 text-left">
          <li class="flex items-center gap-2"><i class="fas fa-hdd"></i> 20GB SSD 저장공간</li>
          <li class="flex items-center gap-2"><i class="fas fa-infinity"></i> 무제한 트래픽</li>
          <li class="flex items-center gap-2"><i class="fas fa-globe"></i> 무료 도메인 제공</li>
          <li class="flex items-center gap-2"><i class="fab fa-wordpress"></i> WordPress 자동설치</li>
          <li class="flex items-center gap-2"><i class="fas fa-database"></i> DB 3개 생성 가능</li>
          <li class="flex items-center gap-2"><i class="fas fa-globe"></i> 도메인 3개 연결 가능</li>
          <li class="flex items-center gap-2"><i class="fas fa-star"></i> 템플릿 기본 제공</li>
          <li class="flex items-center gap-2"><i class="fas fa-shield-alt"></i> 강화된 보안 및 캐시</li>
          <li class="flex items-center gap-2"><i class="fas fa-shield-halved"></i> DDoS 고급 보호</li>
        </ul>
      </div>
    </div>

    <div class="mt-14">
      <a href="/login" class="inline-block px-7 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-base font-semibold shadow-lg transition">
        지금 가입하고 시작하기 →
      </a>
      <p class="text-zinc-400 text-xs mt-2">가입 후 3분 내 워드프레스 설치 완료</p>
    </div>
  </div>
</section>



<!-- 도입문의 -->
<section id="contact" class="relative bg-gradient-to-br from-[#1a1a1f] to-[#0e0e11] py-24 px-6">
  <div class="max-w-2xl mx-auto bg-[#27282e] rounded-3xl shadow-2xl px-10 py-14 text-center text-white relative overflow-hidden group transition-all duration-500 hover:shadow-indigo-700/30">

    <!-- 라이트 효과 -->
    <div class="absolute -top-12 -left-12 w-36 h-36 bg-indigo-500/20 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>

    <!-- 타이틀 -->
    <h2 class="text-3xl sm:text-4xl font-extrabold mb-4 tracking-tight leading-snug">
      도입 상담이<br class="sm:hidden"> 필요하신가요?
    </h2>

    <!-- 설명 텍스트 -->
    <p class="text-zinc-300 mb-6 text-base sm:text-lg leading-relaxed">
      사용 전 궁금한 점이 있다면<br>
      <strong class="text-white">우측 하단 채널톡 아이콘</strong> 또는 아래 버튼을 눌러<br>
      실시간으로 빠르게 문의해보세요!
    </p>

    <!-- CTA 버튼 -->
    <button onclick="ChannelIO('showMessenger');"
            class="relative inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 px-7 py-3 rounded-full font-semibold text-white shadow-lg hover:shadow-indigo-500/40 transition duration-300 group/button">
      <span class="relative z-10"><i class="fas fa-comments text-white/80"></i> 실시간 상담하기</span>
      <span class="absolute inset-0 rounded-full bg-indigo-400/20 blur-sm opacity-0 group-hover/button:opacity-100 transition-opacity duration-500"></span>
    </button>

    <!-- 운영시간 정보 -->
    <div class="mt-6 inline-flex items-center gap-2 text-sm text-white/80 bg-zinc-800 px-4 py-2 rounded-full shadow-inner backdrop-blur">
      <i class="fas fa-clock text-indigo-400"></i>
      평일 10:00 ~ 18:00 (빠른 대응 지원)
    </div>

    <!-- 서브 문구 -->
    <p class="mt-3 text-xs text-zinc-500 italic">※ 업무 외 시간에도 메시지를 남기시면 순차 대응됩니다.</p>
  </div>
</section>


<!-- FAQ Section -->
 
<!-- FAQ Section with Accordion -->
<!-- FAQ Section -->
<section id="faq" class="bg-[#222328] py-24 px-6">
  <div class="max-w-4xl mx-auto">
    <h2 class="text-3xl md:text-4xl font-bold text-white text-center mb-12">자주 묻는 질문 (FAQ)</h2>

    <div class="space-y-5">

      <!-- ✅ FAQ Item -->
      <div class="relative group bg-[#2a2b30] rounded-xl border border-zinc-700 shadow-lg overflow-hidden transition hover:shadow-blue-500/40">
        <div class="absolute -top-20 -left-20 w-[300px] h-[300px] bg-blue-400/20 blur-[100px] opacity-0 group-hover:opacity-80 transition-all duration-700 pointer-events-none rounded-full"></div>
        <button class="w-full text-left px-6 py-5 flex justify-between items-center faq-toggle group">
          <span class="text-white font-medium text-base">❓ 결제 후 바로 사용 가능한가요?</span>
          <svg class="w-5 h-5 text-white transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="faq-content hidden px-6 pb-5 text-sm text-zinc-300">
          💡 네. 결제가 완료되면 자동으로 cPanel 계정이 즉시 생성되며, 이메일로 접속 정보를 안내드립니다. 평균 3분 이내 구축됩니다.
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="relative group bg-[#2a2b30] rounded-xl border border-zinc-700 shadow-lg overflow-hidden transition hover:shadow-pink-500/40">
        <div class="absolute -top-20 -left-20 w-[300px] h-[300px] bg-pink-400/20 blur-[100px] opacity-0 group-hover:opacity-80 transition-all duration-700 pointer-events-none rounded-full"></div>
        <button class="w-full text-left px-6 py-5 flex justify-between items-center faq-toggle group">
          <span class="text-white font-medium text-base">❓ 템플릿은 어떤 방식으로 제공되나요?</span>
          <svg class="w-5 h-5 text-white transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="faq-content hidden px-6 pb-5 text-sm text-zinc-300">
          💡 템플릿은 WordPress에 자동 설치되는 형태로 제공되며, 로그인 후 테마 설정에서 활성화할 수 있습니다.
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="relative group bg-[#2a2b30] rounded-xl border border-zinc-700 shadow-lg overflow-hidden transition hover:shadow-green-500/40">
        <div class="absolute -top-20 -left-20 w-[300px] h-[300px] bg-green-400/20 blur-[100px] opacity-0 group-hover:opacity-80 transition-all duration-700 pointer-events-none rounded-full"></div>
        <button class="w-full text-left px-6 py-5 flex justify-between items-center faq-toggle group">
          <span class="text-white font-medium text-base">❓ 도메인이 없어도 시작할 수 있나요?</span>
          <svg class="w-5 h-5 text-white transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="faq-content hidden px-6 pb-5 text-sm text-zinc-300">
          💡 네. 기본 제공되는 공유 도메인으로 먼저 시작할 수 있으며, 이후 도메인을 연결할 수 있습니다.
        </div>
      </div>

      <!-- FAQ 4 -->
      <div class="relative group bg-[#2a2b30] rounded-xl border border-zinc-700 shadow-lg overflow-hidden transition hover:shadow-purple-500/40">
        <div class="absolute -top-20 -left-20 w-[300px] h-[300px] bg-purple-400/20 blur-[100px] opacity-0 group-hover:opacity-80 transition-all duration-700 pointer-events-none rounded-full"></div>
        <button class="w-full text-left px-6 py-5 flex justify-between items-center faq-toggle group">
          <span class="text-white font-medium text-base">❓ cPanel 로그인은 어떻게 하나요?</span>
          <svg class="w-5 h-5 text-white transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="faq-content hidden px-6 pb-5 text-sm text-zinc-300">
          💡 서비스 개설 후 대시보드에서 <strong>1-click 로그인</strong> 기능으로 접속할 수 있습니다.
        </div>
      </div>

      <!-- FAQ 5 -->
      <div class="relative group bg-[#2a2b30] rounded-xl border border-zinc-700 shadow-lg overflow-hidden transition hover:shadow-orange-500/40">
        <div class="absolute -top-20 -left-20 w-[300px] h-[300px] bg-orange-400/20 blur-[100px] opacity-0 group-hover:opacity-80 transition-all duration-700 pointer-events-none rounded-full"></div>
        <button class="w-full text-left px-6 py-5 flex justify-between items-center faq-toggle group">
          <span class="text-white font-medium text-base">❓ 트래픽/용량 제한은 어떻게 되나요?</span>
          <svg class="w-5 h-5 text-white transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="faq-content hidden px-6 pb-5 text-sm text-zinc-300">
          💡 BASIC 플랜은 트래픽 월 30GB / PRO 플랜은 무제한으로 제공되며, SSD 저장 용량은 각 플랜 기준에 따라 적용됩니다. 디스크 사용량은 대시보드에서 실시간 확인 가능합니다.
        </div>
      </div>

      <!-- FAQ 6 -->
      <div class="relative group bg-[#2a2b30] rounded-xl border border-zinc-700 shadow-lg overflow-hidden transition hover:shadow-red-500/40">
        <div class="absolute -top-20 -left-20 w-[300px] h-[300px] bg-red-400/20 blur-[100px] opacity-0 group-hover:opacity-80 transition-all duration-700 pointer-events-none rounded-full"></div>
        <button class="w-full text-left px-6 py-5 flex justify-between items-center faq-toggle group">
          <span class="text-white font-medium text-base">❓ 환불 정책은 어떻게 되나요?</span>
          <svg class="w-5 h-5 text-white transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="faq-content hidden px-6 pb-5 text-sm text-zinc-300">
          💡 결제일 기준 14일 이내 일할 계산하여 환불이 가능합니다. 이후에는 월 단위 기준으로 환불이 제한되며, 할인 결제 시에는 위약금이 발생할 수 있습니다.
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Footer -->
<footer class="bg-zinc-900 py-16 px-6 text-sm text-zinc-400 border-t border-zinc-700">
  <div class="max-w-7xl mx-auto space-y-6">

    <!-- 상단: 저작권 & 약관 링크 -->
    <div class="text-center space-y-2">
      <p class="text-zinc-500">ⓒ 2018 S&S Works. All rights reserved.</p>
      <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 text-blue-400">
        <button onclick="document.getElementById('refundModal').showModal()" class="hover:underline hover:text-blue-300 transition">환불 정책</button>
        <button onclick="document.getElementById('termsModal').showModal()" class="hover:underline hover:text-blue-300 transition">서비스 이용약관</button>
        <button onclick="document.getElementById('privacyModal').showModal()" class="hover:underline hover:text-blue-300 transition">개인정보 처리방침</button>
      </div>
    </div>

    <!-- 하단: 사업자 정보 -->
    <div class="text-center text-xs text-zinc-500 leading-relaxed space-y-2">
      <p>
        <span class="inline-block">상호명: 에스앤에스웍스</span> |
        <span class="inline-block">서비스명: Hostyle</span> |
        <span class="inline-block">대표자: 김대현</span> |
        <span class="inline-block">사업자등록번호: 522-71-00290</span> |
        <span class="inline-block">통신판매업: 2025-서울강남-03345</span>
      </p>
      <p>
        <span class="inline-block">주소: 서울특별시 강남구 강남대로 112길 47, 2층 369A호</span> |
        <span class="inline-block">홈페이지: <a href="https://www.snsworks.co.kr" class="underline hover:text-white">snsworks.co.kr</a></span> |
        <span class="inline-block">고객센터: 평일 10:00 ~ 18:00</span>
      </p>
    </div>

  </div>
</footer>


<dialog id="refundModal"class="rounded-xl max-w-[90vw] sm:max-w-xl w-full shadow-lg backdrop:bg-black/50 z-50">
  <div class="p-6 bg-white rounded-xl max-h-[80vh] overflow-y-auto">
        <h2 class="text-lg font-bold mb-4">환불 정책 안내</h2>
        <p class="text-sm text-gray-700 leading-relaxed space-y-2">
            결제일 기준 <strong>14일 이내</strong>에는 사용일수만큼 일할 계산되어 <strong>남은 기간에 대해 환불</strong>이 가능합니다.<br><br>

            <strong>서비스 결제를 체결한 사용자는 아래와 같이 결제에 대한 환불을 요구할 수 있습니다.</strong><br>
            - 회사의 귀책 사유료 인한 결제 오류가 발생된 경우<br>
            - 회사의 귀책 사유로 인한 서비스가 중단된 경우<br>
            - 단순 변심으로 인한 환불<br>
            <strong>단, 다음의 경우는 환불이 제한됩니다:</strong><br>
            - 14일 이후: 환불 불가 (월 단위 정산)<br>
            - 할인 결제 시: 위약금 발생 가능 (할인 금액 ÷ 총 개월수 × 잔여 개월수)<br>

            본 환불 정책은 전자상거래법 및 소비자보호법을 준수합니다.
        </p>
        <div class="mt-6 text-end">
            <button onclick="document.getElementById('refundModal').close()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                닫기
            </button>
        </div>
    </div>
    
</dialog>



    <dialog id="privacyModal" class="rounded-xl max-w-[90vw] sm:max-w-xl w-full shadow-lg backdrop:bg-black/50 z-50 open:overflow-hidden">
  <div class="bg-white rounded-xl w-full max-h-[80vh] overflow-y-auto p-6">
    <h2 class="text-lg font-bold mb-4 text-gray-800">개인정보 처리방침</h2>

    <div class="text-sm text-gray-700 leading-relaxed space-y-4">

      <p>에스앤에스웍스(이하 "회사")은 개인정보 보호법에 따라 이용자의 개인정보를 보호하고 권익을 보호하기 위해 다음과 같은 개인정보 처리방침을 수립·공개합니다.</p>

      <p><strong>1. 수집하는 개인정보 항목</strong><br>
        - 필수항목: 이메일, 비밀번호, 이름, 전화번호, 서비스 이용기록, 결제정보(가상계좌/카드 정보) 사업장주소, 프로필 정보, 회사명 , 사업자등록번호<br>
        
      </p>

      <p><strong>2. 개인정보 수집 방법</strong><br>
        - 회원가입 시 사용자가 직접 입력<br>
        - 서비스 이용 중 자동 수집(Cookie, 접속 IP 등)
      </p>

      <p><strong>3. 개인정보 이용 목적</strong><br>
        - 회원가입 및 본인 확인<br>
        - 서비스 제공 및 계약 이행<br>
        - 고객 상담, 민원 처리<br>
        - 요금 정산 및 결제<br>
        - 서비스 개선 및 마케팅 활용(동의 시)
      </p>

      <p><strong>4. 개인정보 보유 및 이용기간</strong><br>
        - 회원 탈퇴 시 즉시 삭제<br>
        - 관계법령에 따라 일정기간 보존되는 경우:<br>
          · 계약 또는 청약철회 기록: 5년<br>
          · 대금결제 및 재화 공급 기록: 5년<br>
          · 소비자 불만 또는 분쟁처리 기록: 3년
      </p>

      <p><strong>5. 개인정보 제3자 제공</strong><br>
        회사는 원칙적으로 이용자의 개인정보를 외부에 제공하지 않습니다. 단, 다음의 경우에는 예외로 합니다:<br>
        - 이용자의 사전 동의를 받은 경우<br>
        - 법령에 의거하거나 수사기관의 요청이 있는 경우
      </p>

      <p><strong>6. 개인정보 처리 위탁</strong><br>
        회사는 서비스 제공을 위해 아래와 같이 개인정보 처리를 위탁할 수 있습니다:<br>
        - 결제처리: 토스페이먼츠㈜<br>
        - 이메일 발송: Amazon SES (또는 Mailgun 등)
      </p>

      <p><strong>7. 정보주체의 권리와 행사 방법</strong><br>
        - 개인정보 열람, 정정, 삭제, 처리정지 요청 가능<br>
        - 회원정보 수정 또는 탈퇴를 통해 직접 처리 가능<br>
        - 또는 개인정보 보호책임자에게 요청 가능
      </p>

      <p><strong>8. 개인정보 보호책임자</strong><br>
        · 이름: 김대현<br>
        · 이메일: support@snsworks.co.kr<br>
        · 연락처: 010-5914-3150
      </p>

      <p><strong>9. 쿠키의 설치/운영 및 거부</strong><br>
        - 웹사이트는 맞춤형 서비스 제공을 위해 쿠키(cookie)를 사용합니다.<br>
        - 사용자는 브라우저 설정을 통해 쿠키 저장을 거부하거나 삭제할 수 있습니다.
      </p>

      <p class="text-xs text-gray-500">
        본 방침은 2025년 6월 27일부터 시행됩니다.
      </p>
    </div>

    <div class="mt-6 text-end">
      <button onclick="document.getElementById('privacyModal').close()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        닫기
      </button>
    </div>
  </div>
</dialog>


<dialog id="termsModal" class="rounded-xl max-w-[90vw] sm:max-w-xl w-full shadow-lg backdrop:bg-black/50 z-50 open:overflow-hidden">
  <div class="bg-white rounded-xl w-full max-h-[80vh] overflow-y-auto p-6">
    <h2 class="text-lg font-bold mb-4 text-gray-800">서비스 이용약관</h2>

    <div class="text-sm text-gray-700 leading-relaxed space-y-4">
      <p>
        본 약관은 귀하가 당사의 웹호스팅 SaaS 서비스를 이용함에 있어 필요한 조건, 권리 및 의무를 규정합니다.
      </p>

      <p>
        <strong>제1조 (목적)</strong><br>
        본 약관은 사용자가 본 서비스에 가입하고, cPanel를 기반으로 한 웹사이트를 생성하고 운영하는 과정에서 발생할 수 있는 기본적인 이용 조건을 규정합니다.
      </p>

      <p>
        <strong>제2조 (서비스 내용)</strong><br>
        당사는 사용자의 신청에 따라 cPanel 기반 웹사이트를 자동으로 생성하며, WHM 기반 리셀러 서버를 통해 웹호스팅 환경을 제공합니다. 서비스 구성은 선택한 요금제에 따라 상이할 수 있습니다.
      </p>

      <p>
        <strong>제3조 (회원가입 및 계정)</strong><br>
        사용자는 유효한 이메일, 비밀번호, 연락처 등의 정보를 제공하고, 정해진 절차를 통해 회원가입을 완료해야 합니다. 회원 정보는 사용자 본인의 책임 하에 관리되어야 하며, 타인에게 공유 또는 양도할 수 없습니다.
      </p>

      <p>
        <strong>제4조 (서비스 이용 요금)</strong><br>
        서비스는 유료이며, 요금제에 따라 월 단위 또는 정기 결제 방식으로 운영됩니다. 결제 금액 및 조건은 서비스 페이지에 명시된 내용을 따릅니다.
      </p>

      <p>
        <strong>제5조 (계정 정지 및 해지)</strong><br>
        다음과 같은 경우 당사는 사전 통보 없이 계정 정지 또는 해지를 할 수 있습니다:<br>
        - 이용약관을 위반하거나 불법적인 콘텐츠를 운영한 경우<br>
        - cPanel 외 목적의 무단 사용, 리소스 과다 사용 등<br>
        - 저작권 침해 목적 사용<br>
        - 기타 서비스 안정성에 심각한 영향을 줄 경우
      </p>

      <p>
        <strong>제6조 (데이터 보관 및 삭제)</strong><br>
        서비스 해지 후 7일간 데이터가 보관되며, 이후 자동 삭제됩니다. 해지 전 백업은 사용자 책임입니다.
      </p>

      <p>
        <strong>제7조 (면책 조항)</strong><br>
        당사는 아래 사유로 인한 피해에 대해 책임지지 않습니다:<br>
        - 사용자의 과실로 인한 정보 유출 또는 손해<br>
        - IDC/서버 장애, 천재지변, 통신망 문제 등 외부 요인<br>
        - 사용자의 콘텐츠 관리 부주의
      </p>

      <p>
        <strong>제8조 (약관 변경)</strong><br>
        당사는 서비스 개선을 위해 약관을 변경할 수 있으며, 변경 시 웹사이트에 사전 공지합니다.
      </p>

      <p class="text-xs text-gray-500">
        본 약관은 2025년 6월 기준으로 작성되었으며, 최신 버전은 서비스 페이지를 통해 확인할 수 있습니다.
      </p>
    </div>

    <div class="mt-6 text-end">
      <button onclick="document.getElementById('termsModal').close()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        닫기
      </button>
    </div>
  </div>
</dialog>



<script>
  document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('.faq-toggle');
    toggles.forEach(btn => {
      btn.addEventListener('click', () => {
        const content = btn.nextElementSibling;
        const isOpen = content.classList.contains('block');

        // 모든 닫기
        document.querySelectorAll('.faq-content').forEach(el => el.classList.add('hidden'));

        // 현재만 열기
        if (!isOpen) {
          content.classList.remove('hidden');
        }
      });
    });
  });
</script>

<!-- Google tag (gtag.js) -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y7BBE8FQ2H"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y7BBE8FQ2H');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-17272418719"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-17272418719');
</script>


<!-- Channel Plugin Load -->
<!-- 채널톡 로드 및 수동 실행 설정 -->
<script>
(function() {
  var w = window;
  if (w.ChannelIO) return;

  var ch = function() {
    ch.c(arguments);
  };
  ch.q = [];
  ch.c = function(args) {
    ch.q.push(args);
  };
  w.ChannelIO = ch;

  function l() {
    if (w.ChannelIOInitialized) return;
    w.ChannelIOInitialized = true;
    var s = document.createElement("script");
    s.type = "text/javascript";
    s.async = true;
    s.src = "https://cdn.channel.io/plugin/ch-plugin-web.js";
    var x = document.getElementsByTagName("script")[0];
    if (x.parentNode) x.parentNode.insertBefore(s, x);
  }

  if (document.readyState === "complete") {
    l();
  } else {
    w.addEventListener("DOMContentLoaded", l);
    w.addEventListener("load", l);
  }
})();
</script>
<script>
  function openChannelTalk() {
    if (window.ChannelIO) {
      ChannelIO('showMessenger');
    } else {
      console.warn("ChannelIO not loaded yet.");
    }
  }
</script>




<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Hostyle",
  "url": "https://hostyle.me",
  "logo": "https://hostyle.me/images/IconOnly_Transparent.png",
  "description": "카페, 병원, 소상공인을 위한 쉽고 빠른 홈페이지 생성 플랫폼",
  "sameAs": [
    "https://www.instagram.com/hostyle_web", 
    "https://www.facebook.com/hostyle"
  ]
}
</script>

</main>

<!-- Smartlog -->
    <script type="text/javascript">
        var hpt_info={'_account':'UHPT-32552', '_server': 'a29'};
    </script>
    <script language="javascript" src="//cdn.smlog.co.kr/core/smart.js" charset="utf-8"></script>
    <noscript><img src="//a29.smlog.co.kr/smart_bda.php?_account=32552" style="display:none;width:0;height:0;" border="0"/></noscript>
</body>

</html>
