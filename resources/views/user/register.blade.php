@extends('user.layout')

@section('title', 'Pendaftaran Peserta')

@section('content')

<!-- Global Container (Light/Clean Style) -->
<section class="min-h-screen relative flex items-center justify-center bg-brand-light overflow-hidden py-32 px-6">
    <!-- Animated background layers (Soft) -->
    <div class="absolute top-0 left-0 w-full h-[150%] bg-blue-500/5 blur-[150px] rounded-full -translate-y-1/2"></div>
    
    <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-24 items-center relative z-10">
        
        <!-- Left Side: Value & Social Proof -->
        <div data-aos="fade-right">
             <div class="inline-flex items-center gap-4 bg-white border border-blue-100 px-6 py-3 rounded-full mb-12 shadow-sm">
                <span class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white"><i class="fas fa-check text-[10px]"></i></span>
                <span class="text-brand-dark font-black text-[10px] tracking-[0.3em] uppercase italic">Pendaftaran Periode 2024</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-brand-dark mb-12 tracking-tighter italic uppercase leading-none">Masa Depan <br /><span class="text-primary italic underline decoration-blue-100 decoration-[10px]">Mulai Di Sini.</span></h1>
            
            <p class="text-xl md:text-2xl text-slate-500 font-medium leading-[2] mb-16 max-w-lg italic opacity-80">
                Bergabunglah dengan ratusan anak lainnya yang telah membuktikan bahwa belajar itu asik dan penuh prestasi.
            </p>
            
            <!-- Value Points -->
            <div class="space-y-10 mb-16">
                <div class="flex gap-8 items-start">
                    <div class="w-12 h-12 bg-white rounded-2xl shadow-xl flex items-center justify-center text-primary shrink-0"><i class="fas fa-users-viewfinder"></i></div>
                    <div>
                        <h4 class="font-black text-brand-dark text-2xl italic mb-2 uppercase tracking-tight">Kelas Super Kecil</h4>
                        <p class="text-slate-400 font-bold text-sm italic opacity-80">Maksimal 5 anak per sesi untuk kenyamanan belajar.</p>
                    </div>
                </div>
                 <div class="flex gap-8 items-start">
                    <div class="w-12 h-12 bg-white rounded-2xl shadow-xl flex items-center justify-center text-primary shrink-0"><i class="fas fa-face-smile-beam"></i></div>
                    <div>
                        <h4 class="font-black text-brand-dark text-2xl italic mb-2 uppercase tracking-tight">Metode Playful</h4>
                        <p class="text-slate-400 font-bold text-sm italic opacity-80">Belajar asik tanpa tekanan melalui pendekatan personal.</p>
                    </div>
                </div>
                 <div class="flex gap-8 items-start">
                    <div class="w-12 h-12 bg-white rounded-2xl shadow-xl flex items-center justify-center text-primary shrink-0"><i class="fas fa-comments"></i></div>
                    <div>
                        <h4 class="font-black text-brand-dark text-2xl italic mb-2 uppercase tracking-tight">Konsultasi Gratis</h4>
                        <p class="text-slate-400 font-bold text-sm italic opacity-80">Bantu pilihkan program terbaik untuk putra-putri Anda.</p>
                    </div>
                </div>
            </div>

            <!-- Social Proof -->
            <div class="p-10 bg-white border border-blue-100 rounded-[3.5rem] shadow-2xl shadow-blue-900/5 inline-flex items-center gap-8">
                 <div class="flex -space-x-4">
                    <img class="w-12 h-12 rounded-full border-4 border-white" src="https://ui-avatars.com/api/?name=User+1&background=2563EB&color=fff" alt="User">
                    <img class="w-12 h-12 rounded-full border-4 border-white" src="https://ui-avatars.com/api/?name=User+2&background=FACC15&color=000" alt="User">
                    <img class="w-12 h-12 rounded-full border-4 border-white" src="https://ui-avatars.com/api/?name=User+3&background=1E40AF&color=fff" alt="User">
                 </div>
                 <div>
                    <p class="text-2xl font-black text-brand-dark italic leading-none">100+ Anak</p>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1 italic">Telah Bergabung Bersama Kami</p>
                 </div>
            </div>
        </div>

        <!-- Right Side: Focus Form -->
        <div class="bg-white p-12 md:p-20 rounded-[5rem] shadow-[0_50px_120px_rgba(30,58,138,0.1)] border border-blue-50 relative overflow-hidden group" data-aos="fade-left">
            <h2 class="text-5xl font-black text-brand-dark mb-16 tracking-tighter italic uppercase">Isi Data <span class="text-primary italic">Pendaftaran.</span></h2>
            
            <form action="#" method="POST" class="space-y-10 relative z-10">
                @csrf
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">Nama Lengkap Anak</label>
                    <input type="text" name="name" id="name" placeholder="Masukkan nama putra/putri Anda" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Umur -->
                    <div>
                        <label for="age" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">Umur Anak</label>
                        <input type="number" name="age" id="age" placeholder="Contoh: 5" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic">
                    </div>
                    <!-- Kelas -->
                    <div>
                        <label for="grade" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">Kelas</label>
                        <input type="text" name="grade" id="grade" placeholder="Contoh: TK-B atau 1 SD" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic">
                    </div>
                </div>

                <!-- Program -->
                <div>
                    <label for="program" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">Pilih Program Belajar</label>
                    <div class="relative">
                        <select name="program" id="program" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white appearance-none transition-all duration-300 italic">
                            <option value="">-- Pilih Program --</option>
                            <option value="pra-tk">Bimbel Pra-TK</option>
                            <option value="tk">Bimbel TK (Calistung Kreatif)</option>
                            <option value="sd">Bimbel SD (Academic Focus)</option>
                        </select>
                        <div class="absolute inset-y-0 right-6 flex items-center pointer-events-none text-primary">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <!-- No HP -->
                <div>
                    <label for="phone" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">Nomor WhatsApp Aktif</label>
                    <input type="tel" name="phone" id="phone" placeholder="Contoh: 0812xxxxxx" class="w-full bg-slate-50 border border-slate-200 px-8 py-6 rounded-3xl font-bold text-lg text-brand-dark focus:outline-none focus:border-primary focus:bg-white transition-all duration-300 placeholder:text-slate-300 italic">
                </div>

                <!-- Trust Badges -->
                <div class="flex flex-wrap gap-8 py-4 opacity-60">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-shield-halved text-primary"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest italic leading-none">Data Aman Terlindungi</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-bolt text-secondary"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest italic leading-none">Respon Cepat Kilat</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-primary text-white py-10 rounded-[3.5rem] font-black text-2xl shadow-2xl shadow-blue-900/20 hover:bg-brand-dark hover:scale-105 transition-all active:scale-[0.98] mt-12 group flex items-center justify-center gap-6 italic uppercase tracking-tighter">
                    Daftar Sekarang <i class="fas fa-arrow-right text-xl transition-transform group-hover:translate-x-3"></i>
                </button>
            </form>
            
            <!-- Bottom Accent -->
            <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-primary/5 rounded-full blur-3xl"></div>
        </div>
    </div>
</section>

@endsection
