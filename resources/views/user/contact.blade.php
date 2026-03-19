@extends('user.layout')

@section('title', 'Hubungi Kami')

@section('content')

<!-- Header Section (Dynamic & Emotional) -->
<section class="pt-48 pb-32 px-6 bg-brand-deepBlue text-white relative overflow-hidden">
    <!-- Animated Glow -->
    <div class="absolute top-0 right-[-10%] w-[60%] h-[120%] bg-blue-500/10 blur-[150px] rounded-full rotate-45 animate-pulse-slow"></div>
    <div class="max-w-7xl mx-auto flex flex-col items-center text-center relative z-10" data-aos="fade-up">
        <span class="text-secondary font-black tracking-[0.5em] uppercase text-[10px] mb-8 block italic underline decoration-white/20 underline-offset-8">Pelayanan Sepenuh Hati</span>
        <h1 class="text-6xl md:text-9xl font-black mb-12 tracking-tighter italic uppercase leading-none">Kami Siap <br /><span class="text-blue-400 italic">Mendengarkan.</span></h1>
        <p class="text-xl md:text-2xl text-blue-100 max-w-2xl font-medium leading-[2] italic opacity-80">
            Jangan biarkan kebingungan menghambat potensi anak Anda. Kami di sini untuk membimbing Anda memilih langkah terbaik.
        </p>
    </div>
</section>

<!-- Contact & Priority Section -->
<section class="py-40 px-6 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
        
        <!-- Priority WhatsApp Card -->
        <div data-aos="fade-right">
             <div class="bg-brand-deepBlue p-16 md:p-24 rounded-[6rem] text-white shadow-[0_60px_100px_rgba(30,58,138,0.2)] relative overflow-hidden group">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-400/10 blur-[100px] rounded-full group-hover:bg-blue-400/20 transition-all duration-1000"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-8 mb-12">
                         <div class="w-24 h-24 bg-white/10 border border-white/10 text-secondary rounded-[2.5rem] flex items-center justify-center text-5xl shadow-2xl transition-transform group-hover:rotate-12 duration-500">
                             <i class="fab fa-whatsapp"></i>
                         </div>
                         <div>
                             <h4 class="text-4xl font-black italic tracking-tighter uppercase leading-none mb-2">Respon Cepat</h4>
                             <p class="text-blue-300 font-bold text-xs uppercase tracking-widest italic opacity-80 underline decoration-blue-500/30">Admin Standby 24/7</p>
                         </div>
                    </div>

                    <h2 class="text-5xl md:text-6xl font-black mb-10 tracking-tighter italic uppercase leading-tight">Konsultasi <span class="text-secondary italic">Gratis</span> Via WhatsApp!</h2>
                    
                    <div class="space-y-8 mb-16 border-t border-white/10 pt-12">
                        <div class="flex items-center gap-6">
                            <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-secondary shadow-inner"><i class="fas fa-check"></i></div>
                            <p class="text-lg font-bold italic text-blue-100 opacity-90">Bantu pilih program yang tepat sesuai umur anak.</p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-secondary shadow-inner"><i class="fas fa-check"></i></div>
                            <p class="text-lg font-bold italic text-blue-100 opacity-90">Info detail jadwal & biaya investasi belajar.</p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-secondary shadow-inner"><i class="fas fa-check"></i></div>
                            <p class="text-lg font-bold italic text-blue-100 opacity-90">Penjadwalan Trial Gratis (S&K Berlaku).</p>
                        </div>
                    </div>

                    <a href="https://wa.me/6283157112597" target="_blank" class="w-full bg-secondary text-brand-dark py-10 rounded-[3.5rem] font-black text-2xl shadow-2xl shadow-yellow-400/30 hover:bg-white transition-all active:scale-[0.98] flex items-center justify-center gap-6 italic uppercase tracking-tighter group/btn">
                        Chat WhatsApp Sekarang <i class="fas fa-paper-plane text-xl transform group-hover/btn:-translate-y-2 group-hover/btn:translate-x-2 transition-transform"></i>
                    </a>
                </div>
             </div>

             <!-- Operational Hours -->
             <div class="mt-16 p-12 bg-blue-50 border border-blue-100 rounded-[4rem] flex flex-col md:flex-row items-center gap-10">
                 <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-brand-blue text-2xl shadow-xl shrink-0"><i class="fas fa-clock"></i></div>
                 <div>
                     <h4 class="text-2xl font-black italic uppercase tracking-tighter text-brand-dark">Jam Operasional Kantor</h4>
                     <p class="text-slate-500 font-bold italic mt-2">Senin - Sabtu <span class="mx-3 opacity-20">|</span> 08:00 - 18:00 WIB</p>
                 </div>
             </div>
        </div>

        <!-- FAQ Section -->
        <div data-aos="fade-left">
            <span class="text-brand-blue font-black tracking-[0.4em] uppercase text-[10px] mb-8 block italic">Pertanyaan Umum</span>
            <h2 class="text-5xl md:text-7xl font-black text-brand-dark mb-16 tracking-tighter italic uppercase leading-[1]">Mungkin Anda <span class="text-brand-blue">Bertanya.</span></h2>
            
            <div class="space-y-10">
                <!-- FAQ 1 -->
                <div class="p-10 bg-white border border-slate-100 rounded-[3.5rem] hover:shadow-2xl hover:shadow-blue-900/5 transition-all duration-500 group">
                    <h4 class="text-xl font-black text-brand-dark italic uppercase tracking-tight mb-4 flex items-center gap-4 group-hover:text-brand-blue transition-colors">
                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-brand-blue flex items-center justify-center text-xs shadow-inner italic">Q</span>
                        Apakah bisa trial gratis dulu?
                    </h4>
                    <p class="text-slate-500 font-medium leading-relaxed italic opacity-80 pl-12 border-l-2 border-blue-50 ml-4">
                        Tentu! Kami menyediakan sesi trial gratis untuk calon siswa agar orang tua dapat melihat langsung metode pengajaran kami.
                    </p>
                </div>
                <!-- FAQ 2 -->
                 <div class="p-10 bg-white border border-slate-100 rounded-[3.5rem] hover:shadow-2xl hover:shadow-blue-900/5 transition-all duration-500 group">
                    <h4 class="text-xl font-black text-brand-dark italic uppercase tracking-tight mb-4 flex items-center gap-4 group-hover:text-brand-blue transition-colors">
                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-brand-blue flex items-center justify-center text-xs shadow-inner italic">Q</span>
                        Bagaimana sistem pembayarannya?
                    </h4>
                    <p class="text-slate-500 font-medium leading-relaxed italic opacity-80 pl-12 border-l-2 border-blue-50 ml-4">
                        Pembayaran dilakukan setiap awal bulan secara flat sesuai program yang dipilih melalui transfer bank atau tunai di kantor.
                    </p>
                </div>
                <!-- FAQ 3 -->
                 <div class="p-10 bg-white border border-slate-100 rounded-[3.5rem] hover:shadow-2xl hover:shadow-blue-900/5 transition-all duration-500 group">
                    <h4 class="text-xl font-black text-brand-dark italic uppercase tracking-tight mb-4 flex items-center gap-4 group-hover:text-brand-blue transition-colors">
                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-brand-blue flex items-center justify-center text-xs shadow-inner italic">Q</span>
                        Area bimbingan di mana saja?
                    </h4>
                    <p class="text-slate-500 font-medium leading-relaxed italic opacity-80 pl-12 border-l-2 border-blue-50 ml-4">
                        Saat ini kami melayani area Bogor dan sekitarnya (Tajur, Pakuan, dsb). Kami juga memiliki opsi tutor datang ke rumah (Private).
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Maps & Location -->
<section class="py-40 bg-brand-light px-6 relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
        <!-- Text & Address -->
        <div data-aos="fade-right">
             <h2 class="text-5xl md:text-7xl font-black text-brand-dark mb-12 tracking-tighter italic uppercase leading-[1]">Kunjungi <span class="text-brand-blue">Rumah Belajar</span> Kami.</h2>
             <div class="space-y-12">
                 <div class="flex gap-10 items-start">
                     <div class="w-16 h-16 bg-white rounded-3xl shadow-xl flex items-center justify-center text-brand-blue shrink-0 text-3xl"><i class="fas fa-map-marked-alt"></i></div>
                     <div>
                        <h4 class="text-3xl font-black italic uppercase tracking-tighter text-brand-dark mb-4">Lokasi Strategis</h4>
                        <p class="text-xl text-slate-500 font-medium leading-relaxed italic opacity-80">Tajur, Bogor Selatan, Kota Bogor, <br /> Jawa Barat - Indonesia</p>
                     </div>
                 </div>
                 <div class="flex gap-10 items-start">
                     <div class="w-16 h-16 bg-white rounded-3xl shadow-xl flex items-center justify-center text-brand-blue shrink-0 text-3xl"><i class="fas fa-id-badge"></i></div>
                     <div>
                        <h4 class="text-3xl font-black italic uppercase tracking-tighter text-brand-dark mb-4">Email Support</h4>
                        <p class="text-xl text-slate-500 font-medium leading-relaxed italic opacity-80 underline decoration-blue-100">halo@ruangbelajar.com</p>
                     </div>
                 </div>
             </div>
        </div>

        <!-- Actual Map -->
        <div class="relative py-12" data-aos="fade-left">
             <div class="w-full h-[600px] bg-slate-300 rounded-[6rem] overflow-hidden shadow-[0_60px_100px_rgba(0,0,0,0.1)] border-[12px] border-white relative group">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15852.793739791404!2d106.81533031024503!3d-6.62228551469502!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5e7b7fcc903%3A0xc3972236a2818619!2sTajur%2C%20Kec.%20Bogor%20Sel.%2C%20Kota%20Bogor%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="grayscale group-hover:grayscale-0 transition-all duration-1000 saturate-[1.5]">
                </iframe>
                <!-- Label Floating -->
                <div class="absolute inset-x-0 bottom-0 p-12 bg-gradient-to-t from-brand-deepBlue/90 via-transparent to-transparent opacity-100 group-hover:opacity-0 transition-opacity duration-1000 text-white">
                    <p class="font-black text-4xl italic uppercase tracking-tighter mb-2">Central Bogor</p>
                    <p class="font-bold text-xs uppercase tracking-[0.3em] italic text-secondary group-hover:text-white">Lebih dekat dengan prestasi anak.</p>
                </div>
             </div>
        </div>
    </div>
</section>

@endsection
