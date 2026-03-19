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
                <div class="absolute top-10 right-10 flex flex-col items-end gap-2">
                    <span
                        class="bg-blue-600 text-white text-[9px] uppercase font-black tracking-widest px-4 py-2 rounded-full shadow-lg italic">Program Unggulan</span>
                    <span
                        class="bg-slate-100 text-slate-400 text-[8px] uppercase font-black tracking-widest px-4 py-2 rounded-full shadow-sm italic">Usia 2-4 Tahun</span>
                </div>
                <div
                    class="w-32 h-32 bg-blue-50 text-primary rounded-[3.5rem] flex items-center justify-center mb-12 group-hover:bg-primary group-hover:text-white transition-all duration-700 shadow-inner group-hover:rotate-12">
                    <i class="fas fa-shapes text-5xl"></i>
                </div>
                <h3 class="text-4xl font-black text-slate-900 mb-8 italic uppercase tracking-tighter">Bimbel Pra-TK</h3>
                <p class="text-slate-500 font-medium leading-[2] mb-12 text-sm opacity-80 italic text-justify">Bantu si kecil mengeksplorasi dunia dengan cara menyenangkan, melatih motorik, dan membangun kepercayaan diri sejak dini.</p>


                <div class="space-y-5 mb-16 border-t border-slate-50 pt-12 flex-grow">
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400 group-hover:text-primary transition-colors">
                        <i class="fas fa-check-circle text-primary"></i> Kelas Kecil
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400 group-hover:text-primary transition-colors">
                        <i class="fas fa-check-circle text-primary"></i> Fokus Personal
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400 group-hover:text-primary transition-colors">
                        <i class="fas fa-check-circle text-primary"></i> Metode Menyenangkan
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400">
                        <i class="fas fa-check-circle text-primary"></i> Laporan Psikologi
                    </div>
                </div>

                <div class="mb-12 p-8 bg-blue-50/50 rounded-3xl border border-blue-100/50">
                    <p class="text-primary text-[10px] font-black uppercase tracking-[0.2em] italic leading-none mb-4 flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-primary rounded-full"></span> Value Utama
                    </p>
                    <p class="text-lg font-black text-slate-900 italic tracking-tighter uppercase leading-tight">
                        Program disesuaikan dengan kebutuhan anak
                    </p>
                </div>

                <a href="https://wa.me/6283157112597" target="_blank"
                    class="group/button block text-center bg-slate-900 text-white px-10 py-7 rounded-[3rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-primary hover:scale-[1.02] transition-all duration-500 shadow-xl shadow-blue-900/10 mt-auto flex items-center justify-center gap-4">
                    Tanya Program Ini <i class="fab fa-whatsapp text-lg"></i>
                </a>
            </div>

            <!-- HIGHLIGHT: Program 2 (TK) -->
            <div class="bg-brand-deepBlue rounded-[6rem] border-8 border-white/5 p-16 md:p-20 shadow-[0_60px_100px_rgba(30,58,138,0.3)] transition-all duration-1000 scale-[1.08] lg:-translate-y-6 relative overflow-hidden flex flex-col z-20"
                data-aos="zoom-in" data-aos-delay="200">
                <div class="absolute top-10 right-10 flex flex-col items-end gap-2">
                    <span
                        class="bg-secondary text-brand-dark text-[10px] uppercase font-black tracking-[0.2em] px-6 py-3 rounded-full shadow-2xl animate-bounce italic">Paling Diminati</span>
                    <span
                        class="bg-white/10 text-white text-[8px] uppercase font-black tracking-widest px-4 py-2 rounded-full backdrop-blur-md italic">SD / TK / PAUD</span>
                </div>

                <!-- Animated Glow Behind -->
                <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-400/20 blur-[120px] rounded-full"></div>

                <div
                    class="w-32 h-32 bg-white/10 border border-white/10 text-secondary rounded-[3.5rem] flex items-center justify-center mb-12 shadow-2xl transition-transform duration-700 hover:-rotate-12">
                    <i class="fas fa-pencil-alt text-5xl"></i>
                </div>

                <h3 class="text-5xl font-black text-white mb-8 italic uppercase tracking-tighter leading-none">Bimbel TK
                    <br /><span class="text-secondary tracking-widest">Juara.</span>
                </h3>
                <p class="text-blue-100 font-medium leading-[2] mb-12 text-sm opacity-90 italic text-justify">Persiapan matang membaca,
                    menulis, dan berhitung (Calistung) yang tidak membosankan untuk bekal masuk SD impian melalui metode visual kreatif.</p>


                <div class="space-y-5 mb-16 border-t border-white/10 pt-12 flex-grow">
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-secondary">
                        <i class="fas fa-check-circle"></i> Kelas Kecil
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-white">
                        <i class="fas fa-check-circle text-secondary"></i> Fokus Personal
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-white">
                        <i class="fas fa-check-circle text-secondary"></i> Metode Menyenangkan
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-white">
                        <i class="fas fa-check-circle text-secondary"></i> Laporan Progress
                    </div>
                </div>

                <div class="mb-12 p-8 bg-white/5 rounded-3xl border border-white/10">
                    <p class="text-secondary text-[10px] font-black uppercase tracking-[0.2em] italic leading-none mb-4 flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-secondary rounded-full"></span> Value Utama
                    </p>
                    <p class="text-xl font-black text-white italic tracking-tighter uppercase leading-tight">
                        Kurikulum Fleksibel & Teruji
                    </p>
                </div>

                <a href="https://wa.me/6283157112597" target="_blank"
                    class="group/button block text-center bg-secondary text-brand-dark px-10 py-8 rounded-[3.5rem] font-black text-sm uppercase tracking-[0.2em] hover:bg-white hover:scale-105 transition-all duration-500 shadow-2xl shadow-yellow-400/30 mt-auto flex items-center justify-center gap-4">
                    Konsultasi Gratis <i class="fab fa-whatsapp text-xl"></i>
                </a>
            </div>

            <!-- Program 3: SD -->
            <div class="bg-white rounded-[5rem] border border-blue-50 p-16 hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-700 hover:-translate-y-4 group relative overflow-hidden flex flex-col"
                data-aos="zoom-in" data-aos-delay="400">
                <div class="absolute top-10 right-10 flex flex-col items-end gap-2">
                    <span
                        class="bg-slate-900 text-white text-[9px] uppercase font-black tracking-widest px-4 py-2 rounded-full shadow-lg italic">Program Unggulan</span>
                    <span
                        class="bg-blue-50 text-primary text-[8px] uppercase font-black tracking-widest px-4 py-2 rounded-full shadow-sm italic">Jenjang SD</span>
                </div>
                <div
                    class="w-32 h-32 bg-blue-50 text-primary rounded-[3.5rem] flex items-center justify-center mb-12 group-hover:bg-primary group-hover:text-white transition-all duration-700 shadow-inner group-hover:rotate-12">
                    <i class="fas fa-book-reader text-5xl"></i>
                </div>
                <h3 class="text-4xl font-black text-slate-900 mb-8 italic uppercase tracking-tighter">Bimbel Jenjang SD</h3>
                <p class="text-slate-500 font-medium leading-[2] mb-12 text-sm opacity-80 italic">Pendampingan penuh tugas
                    sekolah dan persiapan ujian dengan metode pemahaman konsep yang mendalam (bukan hafalan).</p>

                <div class="space-y-5 mb-16 border-t border-slate-50 pt-12 flex-grow">
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400 group-hover:text-primary transition-colors">
                        <i class="fas fa-check-circle text-primary"></i> Kelas Kecil
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400 group-hover:text-primary transition-colors">
                        <i class="fas fa-check-circle text-primary"></i> Fokus Personal
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400 group-hover:text-primary transition-colors">
                        <i class="fas fa-check-circle text-primary"></i> Metode Menyenangkan
                    </div>
                    <div class="flex items-center gap-5 italic text-xs font-black uppercase tracking-widest text-slate-400">
                        <i class="fas fa-check-circle text-primary"></i> Strategi Ujian
                    </div>
                </div>

                <div class="mb-12 p-8 bg-blue-50/50 rounded-3xl border border-blue-100/50">
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] italic leading-none mb-4 flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-slate-300 rounded-full"></span> Value Utama
                    </p>
                    <p class="text-lg font-black text-slate-900 italic tracking-tighter uppercase leading-tight">
                        Program disesuaikan dengan kebutuhan anak
                    </p>
                </div>

                <a href="https://wa.me/6283157112597" target="_blank"
                    class="group/button block text-center bg-brand-dark text-white px-10 py-7 rounded-[3rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-primary transition-all duration-500 shadow-xl shadow-brand-dark/20 mt-auto flex items-center justify-center gap-4">
                    Tanya Program Ini <i class="fab fa-whatsapp text-lg"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Additional Section: Konsultasi & Testimoni (New) -->
    <section class="py-40 bg-white px-6 overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-24 items-center">
            <!-- Consultation -->
            <div class="lg:w-7/12 p-16 md:p-24 bg-slate-900 border border-white/10 rounded-[5rem] relative overflow-hidden group shadow-[0_50px_100px_rgba(0,0,0,0.3)]"
                data-aos="fade-right">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary/20 blur-[120px] rounded-full"></div>
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-secondary/10 blur-[100px] rounded-full"></div>
                
                <span class="text-secondary font-black tracking-[0.4em] uppercase text-[10px] mb-8 block italic">Ready to Start?</span>
                <h4
                    class="text-5xl md:text-6xl font-black text-white tracking-tighter italic uppercase mb-12 leading-none">
                    Konsultasi <span class="text-secondary italic">Gratis</span> <br/>via WhatsApp</h4>
                <p class="text-xl text-slate-400 font-medium leading-[2] mb-12 italic opacity-90">
                    Masih bingung menentukan program yang paling pas untuk si kecil? Bicarakan kebutuhan Anda langsung dengan tim pendidikan kami. <span class="text-white font-black">Fast response & Ramah.</span>
                </p>
                <a href="https://wa.me/6283157112597" target="_blank"
                    class="bg-secondary text-brand-dark px-14 py-8 rounded-[4rem] font-black text-xl uppercase tracking-widest hover:bg-white hover:scale-105 transition-all inline-flex items-center gap-6 group shadow-2xl shadow-yellow-400/20">
                    Klik Chat Sekarang <i class="fab fa-whatsapp text-3xl group-hover:rotate-12 transition-transform"></i>
                </a>
            </div>

            <!-- Mini Testimonial -->
            <div class="lg:w-5/12" data-aos="fade-left">
                <div
                    class="bg-brand-deepBlue p-16 rounded-[4.5rem] text-white shadow-2xl shadow-blue-900/10 relative overflow-hidden group">
                    <div
                        class="absolute -bottom-10 -right-10 opacity-5 text-gray-100 text-[10rem] group-hover:rotate-12 transition-transform duration-700 pointer-events-none">
                        <i class="fas fa-quote-right"></i>
                    </div>
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
                            <p class="font-black text-white italic text-xl uppercase tracking-tighter">Bunda Madha Kafka
                                Ibrahim</p>
                            <p class="text-[10px] text-blue-300 font-bold uppercase tracking-widest italic opacity-60">Wali
                                Murid TK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection