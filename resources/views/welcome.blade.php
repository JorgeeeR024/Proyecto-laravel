<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="InsSchool - Sistema de información para la IED Luis Carlos Galán" />
    <meta name="keywords" content="sistema gestión escolar, IED Luis Carlos Galán, educación Colombia" />
    <meta name="author" content="InsSchool" />
    <title>InsSchool - IED Luis Carlos Galán</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            50: '#f6f8fa',
                            100: '#eaeef2',
                            200: '#d0d9e3',
                            300: '#a6b9cd',
                            400: '#7694b1',
                            500: '#577798',
                            600: '#435e7d',
                            700: '#384c66',
                            800: '#314156',
                            900: '#2d3a4a',
                            950: '#1f2632',
                        },
                        accent: {
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 2s infinite',
                        'slide-in-right': 'slideInRight 0.5s ease-out forwards',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        pulseGlow: {
                            '0%, 100%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
                            '50%': { boxShadow: '0 0 30px rgba(59, 130, 246, 0.8)' }
                        },
                        slideInRight: {
                            '0%': { opacity: '0', transform: 'translateX(20px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-navy-50 via-white to-accent-50 text-navy-900 font-inter min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-md border-b border-navy-100/50 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                        I
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold gradient-text">InsSchool</h1>
                        <p class="text-xs text-navy-500 -mt-1">IED Luis Carlos Galán</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <nav class="hidden md:flex space-x-6">
                        <a href="#inicio" class="text-navy-600 hover:text-accent-600 transition-colors font-medium">Inicio</a>
                        <a href="#features" class="text-navy-600 hover:text-accent-600 transition-colors font-medium">Servicios</a>
                        <a href="#contact" class="text-navy-600 hover:text-accent-600 transition-colors font-medium">Contacto</a>
                    </nav>
                    <a href="{{route('login')}}" class="px-6 py-2.5 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-semibold rounded-xl hover:from-accent-600 hover:to-accent-700 transform hover:scale-105 transition-all shadow-lg hover:shadow-accent-500/25">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        INICIAR SESIÓN
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="inicio" class="relative bg-gradient-to-br from-navy-600 via-navy-700 to-navy-800 text-white py-20 md:py-32 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-accent-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-accent-400/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        </div>
        
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="animate-fade-in-up">
                <div class="inline-flex items-center px-4 py-2 bg-white/10 rounded-full text-accent-200 text-sm font-medium mb-6 glass-effect">
                    <i class="fas fa-star mr-2"></i>
                    Sistema de Información Educativa
                </div>
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    IED Luis Carlos
                    <span class="block gradient-text">Galán</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-4xl mx-auto font-medium leading-relaxed">
                    <span class="bg-gradient-to-r from-accent-200 to-white bg-clip-text text-white">
                        "El pasado es historia, el presente es pasado y el futuro es ahora!"
                    </span>
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                    <a href="#features" class="group px-8 py-4 bg-white text-navy-700 font-semibold rounded-xl hover:bg-accent-50 transition-all shadow-xl hover:shadow-2xl transform hover:scale-105 animate-pulse-glow">
                        <i class="fas fa-arrow-down mr-2 group-hover:animate-bounce"></i>
                        Conoce más
                    </a>
                    <a href="#contact" class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 transition-all glass-effect">
                        <i class="fas fa-phone mr-2"></i>
                        Contáctanos
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative Wave -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 120" class="w-full h-20">
                <path fill="#f6f8fa" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,58.7C960,64,1056,64,1152,58.7C1248,53,1344,43,1392,37.3L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 md:py-32 relative">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold text-navy-800 mb-6">
                    Nuestros <span class="gradient-text">Servicios</span>
                </h2>
                <p class="text-xl text-navy-600 max-w-2xl mx-auto leading-relaxed">
                    Descubre los servicios que hacen de nuestra institución un lugar excepcional para el aprendizaje.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Feature 1 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 card-hover border border-navy-100/50 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent-500 to-accent-600"></div>
                    <div class="w-20 h-20 bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center text-white mb-6 mx-auto group-hover:animate-float shadow-xl">
                        <i class="fas fa-graduation-cap text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-800 mb-4 text-center group-hover:text-accent-600 transition-colors">
                        Educación de Calidad
                    </h3>
                    <p class="text-navy-600 text-center leading-relaxed">
                        Ofrecemos una educación integral con estándares de alta calidad para formar ciudadanos competentes y comprometidos.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 card-hover border border-navy-100/50 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-600"></div>
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white mb-6 mx-auto group-hover:animate-float shadow-xl">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-800 mb-4 text-center group-hover:text-green-600 transition-colors">
                        Comunidad Activa
                    </h3>
                    <p class="text-navy-600 text-center leading-relaxed">
                        Fomentamos la participación activa de toda la comunidad educativa en el proceso formativo y de crecimiento.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 card-hover border border-navy-100/50 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-violet-600"></div>
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center text-white mb-6 mx-auto group-hover:animate-float shadow-xl">
                        <i class="fas fa-book-open text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-800 mb-4 text-center group-hover:text-purple-600 transition-colors">
                        Aprendizaje Innovador
                    </h3>
                    <p class="text-navy-600 text-center leading-relaxed">
                        Implementamos metodologías innovadoras para un aprendizaje significativo, efectivo y transformador.
                    </p>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-6 bg-gradient-to-br from-accent-50 to-accent-100 rounded-2xl">
                    <div class="text-3xl md:text-4xl font-bold text-accent-600 mb-2">500+</div>
                    <div class="text-navy-600 font-medium">Estudiantes</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl">
                    <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">50+</div>
                    <div class="text-navy-600 font-medium">Docentes</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl">
                    <div class="text-3xl md:text-4xl font-bold text-purple-600 mb-2">15+</div>
                    <div class="text-navy-600 font-medium">Años</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl">
                    <div class="text-3xl md:text-4xl font-bold text-orange-600 mb-2">100%</div>
                    <div class="text-navy-600 font-medium">Compromiso</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gradient-to-br from-navy-800 via-navy-900 to-navy-950 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 left-20 w-32 h-32 border border-white rounded-full"></div>
            <div class="absolute bottom-20 right-20 w-24 h-24 border border-white rounded-full"></div>
            <div class="absolute top-40 right-40 w-16 h-16 border border-white rounded-full"></div>
        </div>
        
        <div class="container mx-auto px-4 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <!-- About -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                            I
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">InsSchool</h3>
                            <p class="text-navy-300 text-sm">Sistema Educativo</p>
                        </div>
                    </div>
                    <p class="text-navy-200 leading-relaxed">
                        Sistema de información diseñado específicamente para la IED Luis Carlos Galán, optimizando procesos administrativos y académicos.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/JorgeeeeeeR?mibextid=ZbWKwL" target="_blank" class="group w-12 h-12 rounded-xl bg-navy-700 hover:bg-blue-600 flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-facebook-f group-hover:text-white"></i>
                        </a>
                        <a href="https://www.instagram.com/jorgx_ramir3z?igsh=MWJpcWR5OWJzMmI0eg==" target="_blank" class="group w-12 h-12 rounded-xl bg-navy-700 hover:bg-pink-600 flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-instagram group-hover:text-white"></i>
                        </a>
                        <a href="https://x.com/eliecer_ob53226?t=YzvKh4flzMPaWx0wFBd2Zg&s=09" target="_blank" class="group w-12 h-12 rounded-xl bg-navy-700 hover:bg-blue-400 flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-twitter group-hover:text-white"></i>
                        </a>
                        <a href="https://www.youtube.com/@jorgeeliecerramirezobando6630" target="_blank" class="group w-12 h-12 rounded-xl bg-navy-700 hover:bg-red-600 flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-youtube group-hover:text-white"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Features -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold mb-4">Valores</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-navy-200 hover:text-accent-300 transition-colors">
                            <i class="fas fa-check-circle mr-3 text-accent-400"></i>
                            Comprometido
                        </li>
                        <li class="flex items-center text-navy-200 hover:text-accent-300 transition-colors">
                            <i class="fas fa-lightbulb mr-3 text-accent-400"></i>
                            Innovador
                        </li>
                        <li class="flex items-center text-navy-200 hover:text-accent-300 transition-colors">
                            <i class="fas fa-handshake mr-3 text-accent-400"></i>
                            Sociable
                        </li>
                        <li class="flex items-center text-navy-200 hover:text-accent-300 transition-colors">
                            <i class="fas fa-heart mr-3 text-accent-400"></i>
                            Amigable
                        </li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold mb-4">Contáctanos</h3>
                    <div class="space-y-4 text-navy-200">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt mt-1 text-accent-400"></i>
                            <span>Teran - Yacopí, Colombia</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-accent-400"></i>
                            <span>+57 318 396 70 60</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-envelope mt-1 text-accent-400"></i>
                            <span class="break-all">jorgee_ramirez@soy.sena.edu.co</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-navy-700 pt-8 text-center">
                <p class="text-navy-300 text-sm">
                    &copy; 2025 InsSchool. Sistema de información para la IED Luis Carlos Galán. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>

    <!-- Chatbot Toggle Button -->
    <div id="chatbot-toggle" class="fixed bottom-8 right-8 w-16 h-16 bg-gradient-to-br from-accent-500 to-accent-600 text-white rounded-full flex items-center justify-center cursor-pointer shadow-2xl hover:shadow-accent-500/50 transform hover:scale-110 transition-all duration-300 animate-pulse-glow z-50">
        <i class="fas fa-comments text-xl"></i>
    </div>

    <!-- Chatbot Container -->
    <div id="chatbot" class="fixed bottom-24 right-8 w-80 h-96 bg-white rounded-2xl shadow-2xl flex flex-col opacity-0 invisible transition-all duration-300 transform translate-y-4 z-40 border border-navy-100">
        <div id="chat-header" class="bg-gradient-to-r from-accent-500 to-accent-600 text-white py-4 px-6 rounded-t-2xl flex justify-between items-center">
            <div id="chat-header-title" class="flex items-center">
                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-robot text-sm"></i>
                </div>
                <div>
                    <div class="font-semibold">Asistente Virtual</div>
                    <div class="text-xs text-accent-100">InsSchool</div>
                </div>
            </div>
            <button id="chat-close" class="text-white hover:text-accent-200 hover:bg-white/10 w-8 h-8 rounded-lg flex items-center justify-center transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="chat-messages" class="flex-grow p-4 overflow-y-auto bg-gradient-to-b from-gray-50 to-white">
            <div class="text-center text-xs text-gray-500 mb-4">
                <span class="bg-white px-3 py-1 rounded-full shadow-sm border">
                    Hoy, <span id="current-date"></span>
                </span>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-md mb-3 max-w-[85%] border-l-4 border-accent-500 animate-slide-in-right">
                <div class="flex items-start space-x-2">
                    <div class="w-6 h-6 bg-gradient-to-br from-accent-500 to-accent-600 rounded-full flex items-center justify-center text-white text-xs">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="text-sm text-navy-700">
                        ¡Hola! 👋 Soy el asistente virtual de InsSchool. ¿En qué puedo ayudarte hoy?
                    </div>
                </div>
            </div>
        </div>
        <form id="chat-form" class="p-4 border-t border-gray-200 flex space-x-3">
            <input type="text" id="chat-input" placeholder="Escribe un mensaje..." class="flex-grow border border-gray-300 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all text-sm">
            <button type="submit" id="chat-send" class="bg-gradient-to-r from-accent-500 to-accent-600 text-white px-4 rounded-xl hover:from-accent-600 hover:to-accent-700 transition-all transform hover:scale-105 shadow-lg">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div>

    <script>
        // Formatear la fecha actual
        const fechaActual = new Date();
        const opcionesFecha = { day: 'numeric', month: 'long', year: 'numeric' };
        document.getElementById('current-date').textContent = fechaActual.toLocaleDateString('es-ES', opcionesFecha);

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.card-hover').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Toggle del chatbot
        document.getElementById('chatbot-toggle').addEventListener('click', () => {
            const chatbot = document.getElementById('chatbot');
            const isVisible = !chatbot.classList.contains('opacity-0');
            
            if (isVisible) {
                chatbot.classList.add('opacity-0', 'invisible', 'translate-y-4');
            } else {
                chatbot.classList.remove('opacity-0', 'invisible', 'translate-y-4');
                document.getElementById('chat-input').focus();
            }
        });

        document.getElementById('chat-close').addEventListener('click', () => {
            document.getElementById('chatbot').classList.add('opacity-0', 'invisible', 'translate-y-4');
        });

        // Enviar mensaje por submit del formulario
        document.getElementById('chat-form').addEventListener('submit', (e) => {
            e.preventDefault();
            enviarMensaje();
        });
        
        async function enviarMensaje() {
            const input = document.getElementById('chat-input');
            const messages = document.getElementById('chat-messages');
            const sendButton = document.getElementById('chat-send');
            const userMessage = input.value.trim();
            
            if (!userMessage) return;
        
            // Deshabilitar entrada mientras se procesa
            input.disabled = true;
            sendButton.disabled = true;
            sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            // Mostrar mensaje del usuario
            messages.innerHTML += `
                <div class="flex justify-end mb-3 animate-slide-in-right">
                    <div class="bg-gradient-to-r from-accent-500 to-accent-600 text-white rounded-2xl px-4 py-3 shadow-lg max-w-[85%]">
                        <div class="text-sm">${userMessage}</div>
                    </div>
                </div>`;
            input.value = "";
            
            // Scroll al final de los mensajes
            messages.scrollTop = messages.scrollHeight;
            
            // Mostrar indicador de typing con animación
            messages.innerHTML += `
                <div class='bg-white rounded-2xl p-4 shadow-md mb-3 max-w-[85%] border-l-4 border-accent-500' id='typing'>
                    <div class="flex items-start space-x-2">
                        <div class="w-6 h-6 bg-gradient-to-br from-accent-500 to-accent-600 rounded-full flex items-center justify-center text-white text-xs">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                        </div>
                    </div>
                </div>`;
            messages.scrollTop = messages.scrollHeight;
        
            try {
                // Intenta con diferentes rutas si es necesario
                const response = await axios({
                    method: 'post',
                    url: '../PHP/chatbot.php',
                    data: { mensaje: userMessage },
                    timeout: 30000,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                
                // Remover indicador de typing
                const typingElement = document.getElementById('typing');
                if (typingElement) typingElement.remove();
                
                // Verificar estructura de respuesta
                if (response.data && response.data.choices && response.data.choices[0] && response.data.choices[0].message) {
                    const botResponse = response.data.choices[0].message.content;
                    messages.innerHTML += `
                        <div class="bg-white rounded-2xl p-4 shadow-md mb-3 max-w-[85%] border-l-4 border-accent-500 animate-slide-in-right">
                            <div class="flex items-start space-x-2">
                                <div class="w-6 h-6 bg-gradient-to-br from-accent-500 to-accent-600 rounded-full flex items-center justify-center text-white text-xs">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <div class="text-sm text-navy-700">
                                    ${formatResponse(botResponse)}
                                </div>
                            </div>
                        </div>`;
                } else {
                    throw new Error("Estructura de respuesta inesperada");
                }
            } catch (error) {
                console.error("Error completo:", error);
                const typingElement = document.getElementById('typing');
                if (typingElement) typingElement.remove();
                
                let errorMsg = "No se pudo obtener respuesta del chatbot";
                
                if (error.response) {
                    // Error de la API
                    if (error.response.data && error.response.data.error) {
                        errorMsg = `Error: ${error.response.data.error.message || error.response.data.error}`;
                    } else {
                        errorMsg = `Error ${error.response.status}: ${error.response.statusText}`;
                    }
                } else if (error.request) {
                    // La solicitud fue hecha pero no hubo respuesta
                    errorMsg = "El servidor no respondió. Verifica tu conexión.";
                } else {
                    // Error al configurar la solicitud
                    errorMsg = `Error: ${error.message}`;
                }
                
                messages.innerHTML += `
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-2xl p-4 shadow-md mb-3 max-w-[85%] animate-slide-in-right">
                        <div class="text-sm text-red-700">
                            ${errorMsg}
                        </div>
                    </div>`;
            } finally {
                // Rehabilitar entrada
                input.disabled = false;
                sendButton.disabled = false;
                sendButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
                input.focus();
                messages.scrollTop = messages.scrollHeight;
            }
        }
        
        // Formatear la respuesta para aplicar formato básico
        function formatResponse(text) {
            // Convertir enlaces en hipervínculos
            text = text.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" class="text-accent-600 hover:text-accent-700 underline">$1</a>');
            
            // Convertir saltos de línea en <br>
            text = text.replace(/\n/g, '<br>');
            
            return text;
        }
    </script>
</body>
</html>