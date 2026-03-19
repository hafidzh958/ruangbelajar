@extends('user.layout')

@section('title', 'Program Belajar')

@section('content')

    <!-- Header Section (Clean & Impactful) -->
    <section class="pt-48 pb-32 px-6 bg-white relative overflow-hidden text-center border-b border-blue-50">
        <div class="absolute top-0 right-0 w-[50%] h-[100%] bg-blue-500/5 blur-[150px] rounded-full animate-pulse-slow">
        </div>
        <div class="max-w-7xl mx-auto flex flex-col items-center relative z-10" data-aos="fade-up">
            <span
                class="text-primary font-black tracking-[0.4em] uppercase text-[10px] mb-8 block italic underline decoration-blue-100 underline-offset-8">Pilihan
                Masa Depan</span>
            <h1 class="text-6xl md:text-9xl font-black text-slate-900 mb-12 tracking-tighter italic leading-none uppercase">
                Temukan <br /><span class="text-primary italic">Potensinya.</span></h1>
            <p class="text-xl md:text-2xl text-slate-500 max-w-2xl font-medium leading-[2] italic opacity-80">
                Program bimbingan yang dirancang penuh kasih untuk membentuk karakter cerdas dan kepercayaan diri anak sejak
                dini.
            </p>
        </div>
    </section>

    <!-- Program Grid Section -->
    <section class="py-40 px-6 bg-brand-light relative overflow-hidden">
        <div
            class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 lg:gap-12 relative z-10 items-stretch">

            <!-- Program 1: Pra-TK -->
            <div class="bg-white rounded-[5rem] border border-blue-50 p-16 hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-700 hover:-translate-y-4 group relative overflow-hidden flex flex-col"
                data-aos="zoom-in">
                <div class="absolute top-0 right-0 p-12">
                    <span
                        class="bg-slate-100 text-slate-400 text-[8px] uppercase font-black tracking-widest px-4 py-2 rounded-full shadow-sm italic">Usia
                        2-4 Tahun</span>
                </div>
                <div
                    class="w-32 h-32 bg-blue-50 text-primary rounded-[3.5rem] flex items-center justify-center mb-12 group-hover:bg-primary group-hover:text-white transition-all duration-700 shadow-inner group-hover:rotate-12">
                    <i class="fas fa-shapes text-5xl"></i>
                </div>
                <h3 class="text-4xl font-black text-slate-900 mb-8 italic uppercase tracking-tighter">Bimbel Pra-TK</h3>
                <p class="text-slate-500 font-medium leading-[2] mb-12 text-sm opacity-80 italic">Ajak si kecil
                    bereksplorasi dengan cara yang asik sambil melatih motorik dan kemampuan bersosialisasi perdana mereka.
                </p>

                <div class="space-y-6 mb-16 border-t border-slate-50 pt-12 flex-grow">
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400">
                        <i class="fas fa-check-circle text-primary"></i> Fokus Bermain & Belajar
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400">
                        <i class="fas fa-check-circle text-primary"></i> Kelas Super Kecil
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400">
                        <i class="fas fa-check-circle text-primary"></i> Laporan Mingguan
                    </div>
                </div>

                <div class="mb-10">
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest italic leading-none mb-2">
                        Investasi Mulai</p>
                    <p class="text-3xl font-black text-brand-dark italic tracking-tighter uppercase leading-none">Rp 250rb
                        <span class="text-xs font-bold text-slate-400">/ Bulan</span></p>
                </div>

                <a href="{{ url('/register') }}"
                    class="group/button block text-center bg-slate-50 text-brand-dark px-10 py-7 rounded-[3rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-brand-dark hover:text-white transition-all duration-500 shadow-xl shadow-blue-900/5 mt-auto">
                    Ambil Slot Sekarang
                </a>
            </div>

            <!-- HIGHLIGHT: Program 2 (TK) -->
            <div class="bg-brand-deepBlue rounded-[6rem] border-8 border-white/5 p-16 md:p-20 shadow-[0_60px_100px_rgba(30,58,138,0.3)] transition-all duration-1000 scale-[1.08] lg:-translate-y-6 relative overflow-hidden flex flex-col z-20"
                data-aos="zoom-in" data-aos-delay="200">
                <div class="absolute top-0 right-0 p-12">
                    <span
                        class="bg-secondary text-brand-dark text-[8px] uppercase font-black tracking-widest px-6 py-3 rounded-full shadow-2xl animate-bounce italic">Terpopuler</span>
                </div>

                <!-- Animated Glow Behind -->
                <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-400/20 blur-[120px] rounded-full"></div>

                <div
                    class="w-32 h-32 bg-white/10 border border-white/10 text-secondary rounded-[3.5rem] flex items-center justify-center mb-12 shadow-2xl transition-transform duration-700 hover:-rotate-12">
                    <i class="fas fa-pencil-alt text-5xl"></i>
                </div>

                <h3 class="text-5xl font-black text-white mb-8 italic uppercase tracking-tighter leading-none">Bimbel TK
                    <br /><span class="text-secondary">Juara.</span></h3>
                <p class="text-blue-100 font-medium leading-[2] mb-12 text-sm opacity-90 italic">Persiapan matang membaca,
                    menulis, dan berhitung (Calistung) yang tidak membosankan untuk bekal masuk SD impian.</p>

                <div class="space-y-6 mb-16 border-t border-white/10 pt-12 flex-grow">
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-secondary">
                        <i class="fas fa-star"></i> Metode Visual Kreatif
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-white">
                        <i class="fas fa-check text-secondary"></i> Fokus Personal Anak
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-white">
                        <i class="fas fa-check text-secondary"></i> Laporan Psikologi Belajar
                    </div>
                </div>

                <div class="mb-10">
                    <p class="text-blue-300 text-[10px] font-black uppercase tracking-widest italic leading-none mb-2">
                        Penawaran Spesial</p>
                    <p class="text-4xl font-black text-white italic tracking-tighter uppercase leading-none">Trial Gratis!
                        <span class="text-[10px] text-secondary"></span></p>
                </div>

                <a href="{{ url('/register') }}"
                    class="group/button block text-center bg-secondary text-brand-dark px-10 py-8 rounded-[3.5rem] font-black text-sm uppercase tracking-[0.2em] hover:bg-white hover:scale-105 transition-all duration-500 shadow-2xl shadow-yellow-400/30 mt-auto">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Program 3: SD -->
            <div class="bg-white rounded-[5rem] border border-blue-50 p-16 hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-700 hover:-translate-y-4 group relative overflow-hidden flex flex-col"
                data-aos="zoom-in" data-aos-delay="400">
                <div class="absolute top-0 right-0 p-12">
                    <span
                        class="bg-slate-900 text-white text-[8px] uppercase font-black tracking-widest px-4 py-2 rounded-full shadow-sm italic">Rekomendasi
                        Utama</span>
                </div>
                <div
                    class="w-32 h-32 bg-blue-50 text-primary rounded-[3.5rem] flex items-center justify-center mb-12 group-hover:bg-primary group-hover:text-white transition-all duration-700 shadow-inner group-hover:rotate-12">
                    <i class="fas fa-book-reader text-5xl"></i>
                </div>
                <h3 class="text-4xl font-black text-slate-900 mb-8 italic uppercase tracking-tighter">Bimbel Jenjang SD</h3>
                <p class="text-slate-500 font-medium leading-[2] mb-12 text-sm opacity-80 italic">Pendampingan penuh tugas
                    sekolah dan persiapan ujian dengan metode pemahaman konsep yang mendalam (bukan hafalan).</p>

                <div class="space-y-6 mb-16 border-t border-slate-50 pt-12 flex-grow">
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400">
                        <i class="fas fa-check-circle text-primary"></i> Bedah Konsep PR Sekolah
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400">
                        <i class="fas fa-check-circle text-primary"></i> Strategi Ujian Harian
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400">
                        <i class="fas fa-check-circle text-primary"></i> Kelas Maksimum 5 Siswa
                    </div>
                </div>

                <div class="mb-10">
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest italic leading-none mb-2">
                        Investasi Mulai</p>
                    <p class="text-3xl font-black text-brand-dark italic tracking-tighter uppercase leading-none">Rp 350rb
                        <span class="text-xs font-bold text-slate-400">/ Bulan</span></p>
                </div>

                <a href="{{ url('/register') }}"
                    class="group/button block text-center bg-brand-dark text-white px-10 py-7 rounded-[3rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-primary transition-all duration-500 shadow-xl shadow-brand-dark/20 mt-auto">
                    Ambil Slot Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Additional Section: Konsultasi & Testimoni (New) -->
    <section class="py-40 bg-white px-6 overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-24 items-center">
            <!-- Consultation -->
            <div class="lg:w-7/12 p-16 md:p-24 bg-blue-50 border border-blue-100 rounded-[5rem] relative overflow-hidden group"
                data-aos="fade-right">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-brand-blue/5 blur-[100px] rounded-full"></div>
                <h4
                    class="text-5xl font-black text-brand-dark tracking-tighter italic uppercase underline decoration-secondary decoration-8 underline-offset-10 mb-12">
                    Konsultasi <span class="text-brand-blue italic">Gratis!</span></h4>
                <p class="text-xl text-slate-500 font-medium leading-[2] mb-12 italic opacity-90">
                    Masih bingung menentukan program yang cocok? Klik tombol di bawah untuk berbicara langsung dengan tim
                    kami via WhatsApp. <span class="text-brand-dark font-black">Tanpa biaya apapun.</span>
                </p>
                <a href="https://wa.me/6283157112597" target="_blank"
                    class="bg-brand-dark text-white px-14 py-8 rounded-[4rem] font-black text-xl uppercase tracking-widest hover:bg-brand-blue transition-all inline-flex items-center gap-6 group shadow-2xl">
                    Chat via WhatsApp <i class="fab fa-whatsapp text-2xl group-hover:rotate-12 transition-transform"></i>
                </a>
            </div>

            <!-- Mini Testimonial -->
            <div class="lg:w-5/12" data-aos="fade-left">
                <div
                    class="bg-brand-deepBlue p-16 rounded-[4.5rem] text-white shadow-2xl shadow-blue-900/10 relative overflow-hidden group">
                    <div
                        class="absolute -bottom-10 -right-10 opacity-5 text-gray-100 text-[10rem] group-hover:rotate-12 transition-transform duration-700 pointer-events-none">
                        <i class="fas fa-quote-right"></i></div>
                    <div class="flex gap-2 text-secondary mb-10">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-2xl font-black italic mb-12 leading-relaxed opacity-90 relative z-10">
                        "Tutor sabar banget, anak saya yang tadinya ogah-ogahan belajar TK sekarang malah nagih masuk les
                        terus!"
                    </p>
                    <div class="flex items-center gap-6 relative z-10 border-t border-white/10 pt-10">
                        <div
                            class="w-14 h-14 rounded-2xl bg-white/10 border border-white/5 flex items-center justify-center text-secondary text-2xl font-black italic">
                            B</div>
                        <div>
                            <p class="font-black text-white italic text-xl uppercase tracking-tighter">Bunda Alif</p>
                            <p class="text-[10px] text-blue-300 font-bold uppercase tracking-widest italic opacity-60">Wali
                                Murid TK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection