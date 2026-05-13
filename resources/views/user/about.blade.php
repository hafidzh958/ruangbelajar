@extends('user.layout')

@section('title', 'Tentang Kami')

@section('content')

    <!-- Header Section (Gradient Blue) -->
    <section class="pt-40 pb-24 px-6 bg-brand-deepBlue text-white text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-blue-500/10 blur-[150px] rounded-full rotate-45 -z-10 animate-pulse"></div>
        <div class="max-w-7xl mx-auto flex flex-col items-center relative z-10" data-aos="fade-up">
            <span class="text-secondary font-black tracking-[0.5em] uppercase text-[10px] mb-8 block italic underline decoration-white/20 underline-offset-8">
                {{ $aboutSetting->badge_text ?? 'Legacy & Vision' }}
            </span>
            <h1 class="text-6xl md:text-8xl font-black mb-10 tracking-tighter italic uppercase leading-none">
                {{ $aboutSetting->title ?? 'Membangun Masa Depan' }}
                <br /><span class="text-blue-400 italic">{{ $aboutSetting->highlighted_title ?? 'Bersama Kami.' }}</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-2xl font-medium leading-[1.8] italic opacity-80">
                {{ $aboutSetting->description ?? 'Kisah perjalanan kami dalam menghadirkan solusi pendidikan yang asik, cerdas, dan bermakna bagi setiap anak.' }}
            </p>
        </div>
    </section>


    <!-- Section Cerita (Storytelling) -->
    <section class="py-40 px-6 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
            <!-- Image Column -->
            <div class="relative" data-aos="fade-right">
                <div class="w-full aspect-square rounded-[5rem] overflow-hidden shadow-[0_50px_100px_rgba(0,0,0,0.1)] border-8 border-slate-50 group">
                    <img src="{{ $aboutSetting->hero_image ? asset('storage/'.$aboutSetting->hero_image) : asset('images/about.png') }}"
                        class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 saturate-[1.2]"
                        alt="Learning Scene">
                </div>
                <div class="absolute -top-10 -left-10 w-24 h-24 bg-secondary rounded-full blur-3xl opacity-20 animate-pulse"></div>
            </div>

            <!-- Text Column -->
            <div class="space-y-12" data-aos="fade-left">
                <h2 class="text-5xl font-black text-brand-dark tracking-tighter italic uppercase leading-[1.1]">Kisah Kami
                    Berawal Dari <span class="text-brand-blue italic underline decoration-blue-100 decoration-[6px]">Satu
                        Misi.</span></h2>
                <div class="space-y-8 text-slate-500 font-medium leading-[2.2] text-xl opacity-90 italic">
                    <p>
                        Didirikan dengan kepedulian mendalam terhadap potensi unik setiap anak, Ruang Belajar hadir untuk
                        meruntuhkan batasan metode belajar konvensional yang membosankan.
                    </p>
                    <div
                        class="p-10 bg-blue-50 border-l-8 border-brand-blue rounded-r-[3rem] shadow-sm relative overflow-hidden group">
                        <p
                            class="text-2xl font-black italic text-brand-dark group-hover:text-brand-blue transition-colors duration-500">
                            "Setiap anak adalah bintang yang berhak mendapatkan cara belajar yang paling sesuai dengan
                            dirinya."
                        </p>
                        <div
                            class="absolute bottom-0 right-0 opacity-5 text-8xl group-hover:rotate-12 transition-transform duration-700 pointer-events-none">
                            <i class="fas fa-quote-right"></i></div>
                    </div>
                    <p>
                        Kami percaya bahwa pendidikan bukan hanya tentang angka di rapor, tapi tentang menumbuhkan rasa
                        ingin tahu dan kepercayaan diri sepanjang hayat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Masalah & Solusi (New) -->
    <section class="py-40 bg-brand-light px-6 relative overflow-hidden">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] h-[80%] bg-blue-100/30 blur-[150px] rounded-full">
        </div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-24" data-aos="fade-up">
                <span class="text-brand-blue font-black tracking-[0.4em] uppercase text-xs mb-8 block italic">Problem vs
                    Solution</span>
                <h2 class="text-5xl md:text-7xl font-black text-brand-dark mb-10 tracking-tighter italic uppercase">
                    Pendekatan <span class="text-brand-blue italic">Berbeda.</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:divide-x divide-blue-100">
                <!-- Masalah -->
                <div class="space-y-10 md:pr-16" data-aos="fade-right">
                    <h4
                        class="text-3xl font-black text-brand-dark italic uppercase tracking-tighter border-b-4 border-red-500 w-fit pb-2 mb-10">
                        Kekhawatiran Umum.</h4>
                    <div class="space-y-8">
                        <div class="flex gap-6 items-start">
                            <div
                                class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center shrink-0 mt-2 shadow-sm">
                                <i class="fas fa-times"></i></div>
                            <p class="text-slate-600 font-bold text-lg leading-relaxed italic">Anak sering merasa tertekan
                                dengan materi sekolah yang terlalu padat.</p>
                        </div>
                        <div class="flex gap-6 items-start">
                            <div
                                class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center shrink-0 mt-2 shadow-sm">
                                <i class="fas fa-times"></i></div>
                            <p class="text-slate-600 font-bold text-lg leading-relaxed italic">Metode hafalan yang membuat
                                anak cepat lupa dan tidak memahami konsep.</p>
                        </div>
                        <div class="flex gap-6 items-start">
                            <div
                                class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center shrink-0 mt-2 shadow-sm">
                                <i class="fas fa-times"></i></div>
                            <p class="text-slate-600 font-bold text-lg leading-relaxed italic">Kurangnya perhatian personal
                                karena jumlah siswa di kelas terlalu banyal.</p>
                        </div>
                    </div>
                </div>

                <!-- Solusi -->
                <div class="space-y-10 md:pl-16" data-aos="fade-left">
                    <h4
                        class="text-3xl font-black text-brand-dark italic uppercase tracking-tighter border-b-4 border-brand-blue w-fit pb-2 mb-10 text-brand-blue">
                        Solusi Kami.</h4>
                    <div class="space-y-8">
                        <div class="flex gap-6 items-start">
                            <div
                                class="w-12 h-12 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shrink-0 mt-2 shadow-sm">
                                <i class="fas fa-check"></i></div>
                            <p class="text-slate-600 font-bold text-lg leading-relaxed italic">Belajar santai dengan sistem
                                "Personalized Speed" yang tidak membebani.</p>
                        </div>
                        <div class="flex gap-6 items-start">
                            <div
                                class="w-12 h-12 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shrink-0 mt-2 shadow-sm">
                                <i class="fas fa-check"></i></div>
                            <p class="text-slate-600 font-bold text-lg leading-relaxed italic">Fokus pada "Logic &
                                Reasoning", bukan sekadar menyimpan hafalan teks.</p>
                        </div>
                        <div class="flex gap-6 items-start">
                            <div
                                class="w-12 h-12 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center shrink-0 mt-2 shadow-sm">
                                <i class="fas fa-check"></i></div>
                            <p class="text-slate-600 font-bold text-lg leading-relaxed italic">Kelas kecil yang memastikan
                                setiap anak mendapatkan perhatikan intensif dari tutor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Visi Misi -->
    <section class="py-40 px-6 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 relative">
            <!-- Visi Card -->
            <div class="bg-blue-50 p-20 rounded-[5rem] shadow-2xl shadow-blue-900/5 relative overflow-hidden group hover:-translate-y-4 transition-all duration-700" data-aos="zoom-in">
                <div class="absolute top-0 right-0 p-12 opacity-5 text-gray-900 text-[10rem] group-hover:rotate-12 transition-transform duration-700"><i class="fas fa-eye"></i></div>
                <span class="text-brand-blue font-black tracking-[0.4em] uppercase text-xs mb-8 block italic underline decoration-blue-100 underline-offset-8">Vision</span>
                <h3 class="text-5xl font-black text-brand-dark mb-10 tracking-tighter italic uppercase leading-none">
                    {{ $aboutSetting->vision_title ?? 'Menjadi Rumah Inovasi.' }}
                </h3>
                <p class="text-slate-500 font-medium leading-[2.2] text-xl italic opacity-80">
                    {{ $aboutSetting->vision_description ?? 'Menjadi lembaga bimbingan belajar terdepan yang melahirkan generasi cerdas, mandiri, kreatif.' }}
                </p>
            </div>
            <!-- Misi Card -->
            <div class="bg-yellow-50 p-20 rounded-[5rem] shadow-2xl shadow-yellow-900/5 relative overflow-hidden group hover:-translate-y-4 transition-all duration-700" data-aos="zoom-in" data-aos-delay="200">
                <div class="absolute top-0 right-0 p-12 opacity-5 text-gray-900 text-[10rem] group-hover:-rotate-12 transition-transform duration-700"><i class="fas fa-bullseye"></i></div>
                <span class="text-yellow-600 font-black tracking-[0.4em] uppercase text-xs mb-8 block italic underline decoration-yellow-100 underline-offset-8">Mission</span>
                <h3 class="text-5xl font-black text-brand-dark mb-10 tracking-tighter italic uppercase leading-none">
                    {{ $aboutSetting->mission_title ?? 'Membangun Nilai Nyata.' }}
                </h3>
                <p class="text-slate-500 font-medium leading-[2.2] text-xl italic opacity-80">
                    {{ $aboutSetting->mission_description ?? 'Memberikan pendampingan akademik terbaik secara profesional.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Trust Section (Statistics) -->
    <section class="py-32 bg-brand-deepBlue text-white px-6 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-200/20 to-transparent">
        </div>
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-16 relative z-10 text-center">
            <div data-aos="fade-up">
                <div class="text-6xl font-black mb-4 italic tracking-tighter uppercase"><span class="count-up"
                        data-target="100">0</span>+</div>
                <p class="text-blue-300 font-bold uppercase tracking-[0.4em] text-[10px] italic opacity-60">Siswa Aktif</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="text-6xl font-black mb-4 italic tracking-tighter uppercase"><span class="count-up"
                        data-target="15">0</span>+</div>
                <p class="text-blue-300 font-bold uppercase tracking-[0.4em] text-[10px] italic opacity-60">Tutor
                    Profesional</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="400">
                <div class="text-6xl font-black mb-4 italic tracking-tighter uppercase"><span class="count-up"
                        data-target="98">0</span>%</div>
                <p class="text-blue-300 font-bold uppercase tracking-[0.4em] text-[10px] italic opacity-60">Tingkat Prestasi
                </p>
            </div>
        </div>
    </section>

    <!-- Quick Testimonial Section -->
    <section class="py-32 bg-white px-6">
        <div class="max-w-3xl mx-auto text-center" data-aos="zoom-in">
            <div class="flex gap-2 text-secondary justify-center mb-10">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                    class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
            <p class="text-3xl font-black text-brand-dark italic mb-12 leading-relaxed opacity-90 overflow-hidden">
                "Ruang Belajar bukan sekadar tempat les biasa. Di sini, anak saya menemukan semangat belajarnya kembali."
            </p>
            <div class="flex items-center justify-center gap-6">
                <div
                    class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-brand-blue shadow-sm shrink-0 font-black italic">
                    S
                </div>
                <div class="text-left">
                    <p class="font-black text-brand-dark italic text-xl leading-none">Ibu Sari</p>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest italic opacity-60 mt-2">Wali
                        Murid TK</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section (Storytelling Style) -->
    <section class="py-24 px-6 relative bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="bg-brand-deepBlue rounded-[6rem] p-16 md:p-32 text-center text-white overflow-hidden relative shadow-2xl shadow-blue-900/30 group"
                data-aos="zoom-in">
                <div class="relative z-10 max-w-4xl mx-auto">
                    <h2 class="text-5xl md:text-8xl font-black mb-10 leading-[1] tracking-tighter italic uppercase">Siap
                        Mulai Kisah <br /> <span class="text-secondary italic">Sukses Baru?</span></h2>
                    <p class="text-2xl text-blue-100 font-medium mb-20 opacity-90 max-w-xl mx-auto italic">Waktu terbaik
                        untuk membantu perkembangan potensi anak adalah sekarang.</p>
                    <a href="{{ url('/register') }}"
                        class="bg-secondary text-brand-dark px-20 py-8 rounded-[3.5rem] font-black text-2xl shadow-2xl shadow-yellow-400/40 hover:bg-white hover:scale-105 transition-all active:scale-95 group flex items-center justify-center gap-6 italic uppercase tracking-tighter">
                        Daftar Program Sekarang <i
                            class="fas fa-arrow-right text-xl transform group-hover:translate-x-3 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Count Up Logic (matching home logic)
        function initCountUp() {
            const stats = document.querySelectorAll('.count-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = parseInt(entry.target.getAttribute('data-target'));
                        let current = 0;
                        const duration = 2500;
                        const increment = target / (duration / 16);

                        const updateCount = () => {
                            current += increment;
                            if (current < target) {
                                entry.target.innerText = Math.round(current);
                                requestAnimationFrame(updateCount);
                            } else {
                                entry.target.innerText = target;
                            }
                        };
                        updateCount();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            stats.forEach(s => observer.observe(s));
        }

        document.addEventListener('DOMContentLoaded', initCountUp);
    </script>

    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 4s infinite ease-in-out;
        }

        .animate-pulse-slow {
            animation: pulse 8s infinite ease-in-out;
        }
    </style>

@endsection