<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>مزادي — اكتشف، زايد، اربح</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<style>
    *{margin:0;padding:0;box-sizing:border-box}
    :root{
        --black:#1a2e35;
        --black-deep:#0f1e23;
        --white:#f0e8cc;
        --white-dim:#e8ddb8;
        --accent:#f47c51;
        --accent2:#c95f3a;
        --teal:#2e8a99;
        --teal-light:#3aa0b0;
        --teal-dim:rgba(46,138,153,.15);
    }
    html{scroll-behavior:smooth}
    body{font-family:'Noto Kufi Arabic',sans-serif;background:var(--black-deep);color:var(--white);overflow-x:hidden}

    /* ── Intro Screen ── */
    #intro{position:fixed;inset:0;z-index:9000;background:var(--black-deep);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1.5rem;pointer-events:none}
    #intro-brand{font-family:'Noto Kufi Arabic',sans-serif;font-size:clamp(3rem,10vw,8rem);font-weight:900;letter-spacing:-.01em;color:var(--white);overflow:hidden;line-height:1}
    #intro-brand span{display:inline-block;transform:translateY(110%)}
    #intro-sub{font-size:clamp(1rem,3vw,1.6rem);font-weight:300;color:var(--teal-light);letter-spacing:.15em;opacity:0;text-align:center}
    #intro-cats{display:flex;flex-wrap:wrap;justify-content:center;gap:.6rem;max-width:600px;margin-top:1rem}
    .intro-cat{background:var(--teal-dim);border:1px solid rgba(46,138,153,.35);color:var(--white-dim);padding:.35rem 1rem;border-radius:100px;font-size:.85rem;font-weight:600;opacity:0;transform:translateY(20px) scale(.9)}
    #intro-line{width:0;height:1px;background:linear-gradient(to right,transparent,var(--teal),transparent);margin-top:1.5rem}
    body.intro-active{overflow:hidden}

    #cursor{display:none}
    #cursor-follower{display:none}

    /* Noise overlay */
    body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;z-index:1000;opacity:.5}

    /* Nav */
    nav{position:fixed;top:0;left:0;right:0;z-index:100;padding:1.25rem 4rem;display:flex;justify-content:space-between;align-items:center}
    .nav-logo{font-size:1.5rem;font-weight:900;color:var(--white);letter-spacing:0}
    .nav-links{display:flex;gap:2.5rem;list-style:none}
    .nav-links a{color:rgba(240,232,204,.6);font-size:.85rem;font-weight:400;text-decoration:none;letter-spacing:.05em;transition:color .3s}
    .nav-links a:hover{color:var(--white)}
    .nav-cta{background:var(--accent);color:#fff;padding:.6rem 1.5rem;border-radius:100px;font-size:.85rem;font-weight:700;text-decoration:none;transition:all .3s}
    .nav-cta:hover{background:var(--accent2);transform:scale(1.05)}
    /* Hamburger */
    .nav-hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:.4rem;background:transparent;border:none}
    .nav-hamburger span{display:block;width:24px;height:2px;background:var(--white);border-radius:2px;transition:all .3s}
    .nav-hamburger.open span:nth-child(1){transform:translateY(7px) rotate(45deg)}
    .nav-hamburger.open span:nth-child(2){opacity:0}
    .nav-hamburger.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}
    /* Mobile menu */
    .nav-mobile{display:none;position:fixed;inset:0;top:0;background:rgba(15,30,35,.97);backdrop-filter:blur(20px);z-index:99;flex-direction:column;align-items:center;justify-content:center;gap:2.5rem;opacity:0;pointer-events:none;transition:opacity .3s}
    .nav-mobile.open{display:flex;opacity:1;pointer-events:all}
    .nav-mobile a{color:var(--white);font-size:1.75rem;font-weight:700;text-decoration:none;letter-spacing:0;transition:color .2s}
    .nav-mobile a:hover{color:var(--accent)}
    .nav-mobile .nav-cta{font-size:1rem;padding:.75rem 2.5rem}

    /* Hero */
    #hero{height:100vh;min-height:600px;display:flex;flex-direction:column;justify-content:flex-end;padding:0 4rem 6rem;position:relative;overflow:hidden}
    .hero-bg{position:absolute;inset:0;z-index:0}
    .hero-bg canvas{width:100%;height:100%;display:block}
    .hero-img-overlay{position:absolute;inset:0;background:linear-gradient(to bottom,rgba(15,30,35,.2) 0%,rgba(15,30,35,.6) 55%,rgba(15,30,35,1) 100%);z-index:2}

    /* Slider */
    .slide{position:absolute;inset:0;background-size:cover;background-position:center;opacity:0;z-index:1}
    .slide.active{opacity:.62}

    /* Slide counter */
    .slide-counter{position:absolute;bottom:2rem;right:4rem;z-index:10;display:flex;align-items:center;gap:.75rem;opacity:1}
    .slide-dots{display:flex;gap:.4rem}
    .slide-dot{width:20px;height:2px;background:rgba(240,232,204,.25);border-radius:2px;transition:all .5s;cursor:pointer}
    .slide-dot.active{width:40px;background:var(--accent)}
    .slide-num{font-size:.75rem;color:rgba(240,232,204,.4);letter-spacing:.1em;font-weight:300}

    /* About section — fullscreen pin */
    #about{height:100vh;display:flex;align-items:center;padding:0 4rem;position:relative;overflow:hidden;background:var(--black)}
    .about-inner{display:grid;grid-template-columns:1fr 1fr;gap:6rem;align-items:center;width:100%}

    /* Circle visual */
    .about-circle-wrap{position:relative;display:flex;align-items:center;justify-content:center;height:520px}
    .about-circle-track{position:relative;width:420px;height:420px}

    /* The circle mask — starts above viewport, scrolls into place */
    .about-circle-mask{
        position:absolute;inset:0;
        border-radius:50%;
        overflow:hidden;
        border:1px solid rgba(46,138,153,.35);
        box-shadow:0 0 80px rgba(46,138,153,.12), inset 0 0 60px rgba(15,30,35,.5);
        transform:translateY(-120px);
        opacity:0;
    }

    /* Carousel slides inside circle */
    .about-slide{
        position:absolute;inset:0;
        background-size:cover;
        background-position:center;
        opacity:0;
        transition:none;
        transform:scale(1.06);
    }
    .about-slide.active{opacity:1;transform:scale(1)}

    /* Rotating ring around circle */
    .about-ring{
        position:absolute;inset:-16px;
        border-radius:50%;
        border:1px dashed rgba(46,138,153,.25);
        animation:spinRing 20s linear infinite;
    }
    .about-ring::before{
        content:'✦';
        position:absolute;top:-8px;left:50%;transform:translateX(-50%);
        color:var(--teal-light);font-size:.7rem;
    }
    @keyframes spinRing{to{transform:rotate(360deg)}}

    /* Dot nav for about carousel */
    .about-dots{position:absolute;bottom:-2.5rem;left:50%;transform:translateX(-50%);display:flex;gap:.5rem}
    .about-dot{width:6px;height:6px;border-radius:50%;background:rgba(240,232,204,.2);cursor:pointer;transition:all .4s}
    .about-dot.active{background:var(--accent);transform:scale(1.4)}

    /* Floating label on circle */
    .about-circle-label{
        position:absolute;bottom:2rem;right:-1rem;
        background:rgba(15,30,35,.9);
        backdrop-filter:blur(12px);
        border:1px solid rgba(46,138,153,.3);
        padding:.75rem 1.25rem;
        border-radius:1rem;
        font-size:.8rem;
        color:var(--teal-light);
        font-weight:600;
        white-space:nowrap;
        opacity:0;
        transform:translateY(10px);
    }

    .about-tag{font-size:.75rem;letter-spacing:.15em;color:var(--teal-light);font-weight:600;margin-bottom:1.5rem;opacity:0;transform:translateY(20px)}
    .about-title{font-size:clamp(2rem,4vw,3.5rem);font-weight:900;letter-spacing:-.01em;line-height:1.25;margin-bottom:2rem;overflow:visible}
    .about-title .line{display:block;overflow:hidden;padding-bottom:.15em}
    .about-title .word{display:inline-block;transform:translateY(110%)}
    .about-body{font-size:1rem;line-height:1.8;color:rgba(240,232,204,.6);font-weight:300;margin-bottom:2.5rem;opacity:0;transform:translateY(20px)}
    .about-stats{display:flex;gap:3rem;opacity:0;transform:translateY(20px)}
    .about-stat-num{font-size:2.5rem;font-weight:900;color:var(--accent);line-height:1}
    .about-stat-label{font-size:.8rem;color:rgba(240,232,204,.4);margin-top:.3rem}

    /* Section reveal wrapper */
    .reveal-section{opacity:0;transform:translateY(60px)}

    .hero-tag{display:inline-flex;align-items:center;gap:.5rem;background:var(--teal-dim);border:1px solid rgba(46,138,153,.35);color:var(--teal-light);padding:.4rem 1rem;border-radius:100px;font-size:.8rem;font-weight:600;letter-spacing:.08em;margin-bottom:2rem;opacity:0}
    .hero-title{font-size:clamp(3.5rem,9vw,9rem);font-weight:900;line-height:1.2;letter-spacing:-.01em;overflow:visible;margin-bottom:2rem}
    .hero-title .line{display:block;overflow:hidden;padding-bottom:.15em}
    .hero-title .word{display:inline-block;transform:translateY(110%)}
    .hero-title .accent-word{color:var(--accent)}
    .hero-bottom{display:flex;justify-content:space-between;align-items:flex-end;gap:2rem;opacity:0}
    .hero-desc{max-width:380px;font-size:1rem;line-height:1.7;color:rgba(240,232,204,.65);font-weight:300}
    .hero-actions{display:flex;gap:1rem;flex-shrink:0}
    .btn-primary{background:var(--accent);color:#fff;padding:.9rem 2.5rem;border-radius:100px;font-size:.95rem;font-weight:700;text-decoration:none;transition:all .4s cubic-bezier(.23,1,.32,1);display:inline-flex;align-items:center;gap:.5rem}
    .btn-primary:hover{background:var(--accent2);transform:translateY(-3px);box-shadow:0 20px 40px rgba(244,124,81,.25)}
    .btn-outline{border:1px solid rgba(240,232,204,.25);color:var(--white);padding:.9rem 2.5rem;border-radius:100px;font-size:.95rem;font-weight:400;text-decoration:none;transition:all .4s;display:inline-flex;align-items:center;gap:.5rem}
    .btn-outline:hover{border-color:var(--teal-light);color:var(--teal-light);transform:translateY(-3px)}

    /* ── Scroll Progress Bar ── */
    #scroll-bar{position:fixed;top:0;left:0;height:2px;background:linear-gradient(to right,var(--teal),var(--accent));width:0%;z-index:9999;transform-origin:left}

    /* ── Magnetic btn ── */
    .btn-primary,.btn-outline,.nav-cta{will-change:transform}

    /* ── Reveal word spans ── */
    .rw{display:inline-block;overflow:hidden;vertical-align:bottom;line-height:1.3;padding-bottom:.1em}
    .rw span{display:inline-block;transform:translateY(105%);opacity:0}

    /* ── Section line accent ── */
    .line-accent{display:block;width:0;height:1px;background:linear-gradient(to right,var(--teal),transparent);margin-bottom:2.5rem;margin-top:.5rem}

    /* ── Marquee speed control ── */
    .marquee-track{will-change:transform}

    /* ── Stat dividers ── */
    .stat-divider{width:1px;height:0;background:rgba(240,232,204,.1);align-self:center}
    .scroll-line{width:1px;height:60px;background:linear-gradient(to bottom,var(--teal-light),transparent);animation:scrollLine 2s ease-in-out infinite}
    @keyframes scrollLine{0%{transform:scaleY(0);transform-origin:top}50%{transform:scaleY(1);transform-origin:top}51%{transform:scaleY(1);transform-origin:bottom}100%{transform:scaleY(0);transform-origin:bottom}}
    .scroll-indicator{position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:.5rem;opacity:0;z-index:10}

    /* Stats strip */
    #stats{padding:4rem;border-top:1px solid rgba(240,232,204,.08);border-bottom:1px solid rgba(240,232,204,.08);display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;background:var(--black)}
    .stat-item{text-align:center;opacity:0}
    .stat-num{font-size:clamp(2rem,5vw,4.5rem);font-weight:900;color:var(--accent);letter-spacing:-.01em;line-height:1}
    .stat-label{font-size:.85rem;color:rgba(240,232,204,.5);margin-top:.5rem;letter-spacing:.05em;font-weight:300}

    /* Categories */
    #categories{padding:6rem 4rem;position:relative}
    .section-label{font-size:.75rem;letter-spacing:.15em;color:var(--teal-light);font-weight:600;margin-bottom:1.5rem;opacity:0}
    .section-title{font-size:clamp(2rem,4vw,3.5rem);font-weight:900;letter-spacing:-.01em;line-height:1.25;margin-bottom:4rem;overflow:visible}
    .section-title .line{display:block;overflow:hidden;padding-bottom:.15em}
    .section-title .word{display:inline-block;transform:translateY(110%)}

    /* Scattered bubbles layout */
    .cats-orbit-wrap{position:relative;display:flex;align-items:center;justify-content:center;min-height:600px}
    .cats-orbit-circle{display:none}
    .cats-grid{
        position:relative;
        width:100%;
        max-width:900px;
        height:580px;
    }
    .cat-card{
        background:rgba(46,138,153,.07);
        border:1px solid rgba(46,138,153,.18);
        border-radius:50%;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        text-align:center;
        text-decoration:none;
        color:var(--white);
        transition:border-color .4s,background .4s,box-shadow .4s,transform .4s;
        opacity:0;
        position:absolute;
        overflow:hidden;
        will-change:transform,opacity;
        cursor:pointer;
    }
    .cat-card::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at center,rgba(46,138,153,.18),transparent 70%);opacity:0;transition:opacity .4s}
    .cat-card:hover{border-color:rgba(46,138,153,.5);background:rgba(46,138,153,.15);box-shadow:0 0 30px rgba(46,138,153,.2);transform:scale(1.08)!important}
    .cat-card:hover::before{opacity:1}
    .cat-icon{display:flex;align-items:center;justify-content:center;margin-bottom:.5rem}
    .cat-icon svg{width:28px;height:28px;stroke:var(--teal-light);stroke-width:1.5}
    .cat-name{font-size:.78rem;font-weight:700;letter-spacing:.02em;padding:0 .4rem;line-height:1.2}
    .cat-count{font-size:.65rem;color:rgba(240,232,204,.4);margin-top:.2rem}

    /* Products marquee */
    #marquee-section{padding:4rem 0;overflow:hidden;border-top:1px solid rgba(240,232,204,.06);opacity:1}
    .marquee-track{display:flex;gap:1.5rem;width:max-content;animation:marquee 40s linear infinite}
    .marquee-track:hover{animation-play-state:paused}
    @keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
    .marquee-item{flex-shrink:0;width:260px;background:rgba(46,138,153,.05);border:1px solid rgba(46,138,153,.1);border-radius:1.25rem;overflow:hidden;transition:all .4s}
    .marquee-item:hover{border-color:rgba(244,124,81,.35);transform:translateY(-5px)}
    .marquee-img{width:100%;height:160px;object-fit:cover;background:rgba(46,138,153,.08);display:flex;align-items:center;justify-content:center;font-size:3rem}
    .marquee-info{padding:1rem}
    .marquee-title{font-size:.9rem;font-weight:600;margin-bottom:.4rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .marquee-price{font-size:1.1rem;font-weight:900;color:var(--accent)}

    /* Auctions */
    #auctions{padding:6rem 4rem}
    .auctions-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:2rem}
    .auction-card{background:rgba(46,138,153,.04);border:1px solid rgba(46,138,153,.1);border-radius:2rem;overflow:hidden;opacity:0;transform:translateY(40px);transition:all .5s cubic-bezier(.23,1,.32,1)}
    .auction-card:hover{border-color:rgba(244,124,81,.35);transform:translateY(-6px)!important}
    .auction-img{width:100%;height:220px;object-fit:cover;background:rgba(46,138,153,.08);display:flex;align-items:center;justify-content:center;font-size:4rem;position:relative}
    .auction-badge{position:absolute;top:1rem;right:1rem;background:rgba(15,30,35,.85);backdrop-filter:blur(10px);border:1px solid rgba(244,124,81,.3);color:var(--accent);padding:.3rem .8rem;border-radius:100px;font-size:.75rem;font-weight:700}
    .auction-body{padding:1.5rem}
    .auction-title{font-size:1rem;font-weight:700;margin-bottom:.5rem}
    .auction-meta{display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem}
    .auction-price{font-size:1.4rem;font-weight:900;color:var(--accent)}
    .auction-timer{font-size:.8rem;color:rgba(240,232,204,.5);display:flex;align-items:center;gap:.3rem}
    .auction-btn{display:block;text-align:center;background:var(--accent);color:#fff;padding:.75rem;border-radius:100px;font-weight:700;font-size:.9rem;text-decoration:none;transition:all .3s}
    .auction-btn:hover{background:var(--accent2);transform:scale(1.02)}

    /* CTA section */
    #cta{padding:8rem 4rem;text-align:center;position:relative;overflow:hidden}
    #cta::before{content:'';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:600px;height:600px;background:radial-gradient(circle,rgba(46,138,153,.1) 0%,transparent 70%);pointer-events:none}
    .cta-title{font-size:clamp(2.5rem,6vw,6rem);font-weight:900;letter-spacing:-.01em;line-height:1.25;margin-bottom:2rem;overflow:visible}
    .cta-title .line{display:block;overflow:hidden;padding-bottom:.15em}
    .cta-title .word{display:inline-block;transform:translateY(110%)}

    /* CTA big buttons */
    .cta-btn-big{
        font-size:1.25rem;
        padding:1.2rem 3.5rem;
        border-radius:100px;
        position:relative;
        overflow:hidden;
    }
    /* Pulse glow — primary button */
    .btn-primary.cta-btn-big{
        animation:ctaPulse 2.4s ease-in-out infinite;
    }
    @keyframes ctaPulse{
        0%,100%{box-shadow:0 0 0 0 rgba(244,124,81,.55),0 8px 30px rgba(244,124,81,.25)}
        50%{box-shadow:0 0 0 18px rgba(244,124,81,0),0 8px 30px rgba(244,124,81,.4)}
    }
    /* Shimmer sweep — outline button */
    .cta-btn-shimmer::after{
        content:'';
        position:absolute;
        top:0;left:-75%;
        width:50%;height:100%;
        background:linear-gradient(120deg,transparent 0%,rgba(240,232,204,.18) 50%,transparent 100%);
        animation:ctaShimmer 2.2s ease-in-out infinite;
        pointer-events:none;
    }
    @keyframes ctaShimmer{
        0%{left:-75%}
        60%,100%{left:130%}
    }

    /* Footer */
    footer{padding:3rem 4rem;border-top:1px solid rgba(240,232,204,.08);display:flex;justify-content:space-between;align-items:center}
    .footer-logo{font-size:1.2rem;font-weight:900;color:var(--teal-light)}
    .footer-copy{font-size:.8rem;color:rgba(240,232,204,.3)}

    @media(max-width:1024px){
        nav{padding:1.25rem 2rem}
        #hero{padding:0 2rem 5rem}
        #stats{padding:3rem 2rem}
        #about{padding:5rem 2rem}
        #categories,#auctions,#cta{padding:5rem 2rem}
        footer{padding:2.5rem 2rem}
    }

    @media(max-width:768px){
        nav{padding:1rem 1.25rem}
        .nav-links{display:none}
        .nav-cta{display:none}
        .nav-hamburger{display:flex}
        .nav-mobile{display:flex}

        #hero{padding:0 1.25rem 5rem;min-height:100svh}
        .hero-title{font-size:clamp(2.8rem,13vw,5rem)}
        .hero-bottom{flex-direction:column;align-items:flex-start;gap:1.5rem}
        .hero-desc{max-width:100%;font-size:.95rem}
        .hero-actions{flex-wrap:wrap;gap:.75rem}
        .btn-primary,.btn-outline{padding:.8rem 1.75rem;font-size:.9rem}

        #stats{padding:2.5rem 1.25rem;grid-template-columns:repeat(3,1fr);gap:.75rem}
        .stat-num{font-size:clamp(1.5rem,7vw,2.5rem)}
        .stat-label{font-size:.72rem}

        #about{height:auto;padding:4rem 1.25rem}
        .about-inner{grid-template-columns:1fr;gap:2.5rem}
        .about-circle-wrap{height:280px}
        .about-circle-track{width:260px;height:260px}
        .about-stats{gap:1.5rem}
        .about-stat-num{font-size:2rem}

        #categories{padding:4rem 1.25rem}
        .section-title{margin-bottom:2.5rem}
        /* Switch to responsive grid on mobile */
        .cats-orbit-wrap{min-height:unset}
        .cats-grid{
            position:static;
            height:auto!important;
            max-width:100%;
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:.75rem;
        }
        .cat-card{
            position:static!important;
            width:100%!important;
            height:auto!important;
            border-radius:1rem;
            padding:1rem .5rem;
            opacity:1!important;
            transform:none!important;
        }
        .cat-icon svg{width:22px;height:22px}
        .cat-name{font-size:.75rem}

        #auctions{padding:4rem 1.25rem}
        .auctions-grid{grid-template-columns:1fr;gap:1.25rem}

        #cta{padding:5rem 1.25rem}
        .cta-title{font-size:clamp(2.5rem,12vw,4rem)}

        .slide-counter{right:1.25rem;bottom:1.25rem}
        footer{padding:2rem 1.25rem;flex-direction:column;gap:.75rem;text-align:center}

        .marquee-item{width:220px}
        .marquee-img{height:140px}
    }

    @media(max-width:400px){
        .cats-grid{grid-template-columns:repeat(2,1fr)}
        #stats{grid-template-columns:1fr}
        .stat-item+.stat-item{border-top:1px solid rgba(240,232,204,.08);padding-top:1.5rem}
    }
</style>
</head>


<body class="intro-active">

<!-- ══ INTRO SCREEN ══ -->
<div id="intro">
    <div id="intro-brand"><span>Mazadi</span></div>
    <div id="intro-sub">اكتشف · زايد · اربح</div>
    <div id="intro-line"></div>
    <div id="intro-cats">
        @php
            $introCats = \App\Models\Category::where('status',1)->orderBy('name')->take(8)->pluck('name')->toArray();
            if(empty($introCats)) $introCats = ['إلكترونيات','سيارات','عقارات','ملابس','أثاث','كتب','رياضة','مجوهرات'];
        @endphp
        @foreach($introCats as $c)
            <div class="intro-cat">{{ $c }}</div>
        @endforeach
    </div>
</div>

<!-- Scroll Progress Bar -->
<div id="scroll-bar"></div>

<!-- Custom Cursor -->
<div id="cursor"></div>
<div id="cursor-follower"></div>

<!-- Navigation -->
<nav>
    <div class="nav-logo">مزادي</div>
    <ul class="nav-links">
        <li><a href="{{ route('products.index') }}">المنتجات</a></li>
        <li><a href="{{ route('categories.index') }}">التصنيفات</a></li>
        @auth
            <li><a href="{{ route('dashboard') }}">إعلاناتي</a></li>
        @else
            <li><a href="{{ route('login') }}">دخول</a></li>
        @endauth
    </ul>
    @auth
        <div style="display:flex;align-items:center;gap:.75rem">
            <a href="{{ route('products.create') }}" class="nav-cta">+ أضف إعلان</a>
            <!-- User Dropdown -->
            <div style="position:relative">
                <button id="wlc-user-btn" onclick="toggleWlcMenu()" style="display:flex;align-items:center;gap:.5rem;padding:.4rem .75rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.3);border-radius:100px;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;transition:all .3s">
                    <div style="width:26px;height:26px;background:#2e8a99;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:900;color:#fff">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    {{ Auth::user()->name }}
                    <svg id="wlc-chevron" width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transition:transform .2s"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="wlc-user-dropdown" style="position:absolute;left:0;top:calc(100% + .6rem);width:200px;background:#1a2e35;border:1px solid rgba(46,138,153,.2);border-radius:.85rem;padding:.5rem;display:none;z-index:200;box-shadow:0 8px 32px rgba(0,0,0,.5)">
                    <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:.6rem;padding:.6rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:all .2s" onmouseover="this.style.background='rgba(46,138,153,.1)';this.style.color='#f0e8cc'" onmouseout="this.style.background='transparent';this.style.color='rgba(240,232,204,.7)'">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        إعلاناتي
                    </a>
                    <a href="{{ route('orders.index') }}" style="display:flex;align-items:center;gap:.6rem;padding:.6rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:all .2s" onmouseover="this.style.background='rgba(46,138,153,.1)';this.style.color='#f0e8cc'" onmouseout="this.style.background='transparent';this.style.color='rgba(240,232,204,.7)'">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        طلباتي
                    </a>
                    <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:.6rem;padding:.6rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:all .2s" onmouseover="this.style.background='rgba(46,138,153,.1)';this.style.color='#f0e8cc'" onmouseout="this.style.background='transparent';this.style.color='rgba(240,232,204,.7)'">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        الملف الشخصي
                    </a>
                    <div style="border-top:1px solid rgba(46,138,153,.12);margin:.35rem 0"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="display:flex;align-items:center;gap:.6rem;width:100%;padding:.6rem .75rem;color:rgba(244,124,81,.7);background:transparent;border:none;border-radius:.5rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.82rem;cursor:pointer;transition:all .2s;text-align:right" onmouseover="this.style.background='rgba(244,124,81,.08)';this.style.color='#f47c51'" onmouseout="this.style.background='transparent';this.style.color='rgba(244,124,81,.7)'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            تسجيل خروج
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <a href="{{ route('register') }}" class="nav-cta">ابدأ الآن</a>
    @endauth
    <button class="nav-hamburger" id="nav-hamburger" aria-label="القائمة">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- Mobile Menu -->
<div class="nav-mobile" id="nav-mobile">
    <a href="{{ route('products.index') }}" onclick="closeMobileMenu()">المنتجات</a>
    <a href="{{ route('categories.index') }}" onclick="closeMobileMenu()">التصنيفات</a>
    @auth
        <a href="{{ route('dashboard') }}" onclick="closeMobileMenu()">إعلاناتي</a>
        <a href="{{ route('products.create') }}" class="nav-cta" onclick="closeMobileMenu()">+ أضف إعلان</a>
    @else
        <a href="{{ route('login') }}" onclick="closeMobileMenu()">دخول</a>
        <a href="{{ route('register') }}" class="nav-cta" onclick="closeMobileMenu()">ابدأ الآن</a>
    @endauth
</div>

<!-- Hero Section -->
<section id="hero">
    <div class="hero-bg">
        <canvas id="webgl-canvas"></canvas>
    </div>

    <!-- Background Slider -->
    <div class="slide active" style="background-image:url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1800&q=80&auto=format&fit=crop')"></div>
    <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1800&q=80&auto=format&fit=crop')"></div>
    <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=1800&q=80&auto=format&fit=crop')"></div>
    <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=1800&q=80&auto=format&fit=crop')"></div>
    <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=1800&q=80&auto=format&fit=crop')"></div>

    <div class="hero-img-overlay"></div>

    <!-- Slide counter -->
    <div class="slide-counter" id="slide-counter">
        <div class="slide-dots" id="slide-dots">
            <div class="slide-dot active"></div>
            <div class="slide-dot"></div>
            <div class="slide-dot"></div>
            <div class="slide-dot"></div>
            <div class="slide-dot"></div>
        </div>
        <span class="slide-num" id="slide-num">01 / 05</span>
    </div>

    <div style="position:relative;z-index:10">
        <div class="hero-tag" id="hero-tag">
            <span>✦</span> السوق الأول للمزادات في المنطقة
        </div>
        <h1 class="hero-title" id="hero-title">
            <span class="line">
                <span class="rw"><span>اكتشف</span></span>
                <span> </span>
                <span class="rw accent-word"><span>وزايد</span></span>
            </span>
            <span class="line">
                <span class="rw"><span>واربح</span></span>
                <span> </span>
                <span class="rw"><span>كل</span></span>
                <span> </span>
                <span class="rw"><span>يوم</span></span>
            </span>
        </h1>
        <div class="hero-bottom" id="hero-bottom">
            <p class="hero-desc">
                منصة مزادات وإعلانات مبوبة تجمع البائعين والمشترين في تجربة سلسة وآمنة. آلاف المنتجات تنتظرك.
            </p>
            <div class="hero-actions">
                <a href="{{ route('products.index') }}" class="btn-primary">استكشف الآن ←</a>
                @guest
                    <a href="{{ route('register') }}" class="btn-outline">انضم مجاناً</a>
                @endguest
            </div>
        </div>
    </div>

    <div class="scroll-indicator" id="scroll-ind">
        <div class="scroll-line"></div>
    </div>
</section>

<!-- About Section — fullscreen -->
<section id="about">
    <div class="about-inner">

        <!-- Circle Carousel Visual -->
        <div class="about-circle-wrap">
            <div class="about-circle-track">
                <div class="about-ring"></div>
                <div class="about-circle-mask" id="about-circle">

                    <!-- Shopping images carousel -->
                    {{-- <div class="about-slide active" style="background-image:url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=900&q=80&auto=format&fit=crop')"></div> --}}
                    <div class="about-slide" style="background-image:url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=900&q=80&auto=format&fit=crop')"></div>
                    <div class="about-slide" style="background-image:url('https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=900&q=80&auto=format&fit=crop')"></div>
                    <div class="about-slide" style="background-image:url('https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=900&q=80&auto=format&fit=crop')"></div>
                    <div class="about-slide" style="background-image:url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=900&q=80&auto=format&fit=crop')"></div>

                </div>

                <!-- Dot nav -->
                <div class="about-dots" id="about-dots">
                    <div class="about-dot active"></div>
                    <div class="about-dot"></div>
                    <div class="about-dot"></div>
                    <div class="about-dot"></div>
                    <div class="about-dot"></div>
                </div>

                <!-- Floating label -->
                <div class="about-circle-label" id="about-circle-label">🛍️ تسوق بأمان</div>
            </div>
        </div>

        <!-- Text side -->
        <div>
            <p class="about-tag" id="about-tag">— من نحن</p>
            <h2 class="about-title">
                <span class="line"><span class="word">سوق</span> <span class="word">يثق</span></span>
                <span class="line"><span class="word">فيه</span> <span class="word" style="color:var(--accent)">الجميع</span></span>
            </h2>
            <p class="about-body" id="about-body">
                مزادي منصة رائدة تجمع البائعين والمشترين في بيئة آمنة وشفافة. نؤمن بأن كل شخص يستحق الحصول على أفضل صفقة، سواء كنت تبيع أو تشتري أو تزايد.
            </p>
            <div class="about-stats" id="about-stats">
                <div>
                    <div class="about-stat-num">10K+</div>
                    <div class="about-stat-label">إعلان نشط</div>
                </div>
                <div>
                    <div class="about-stat-num">98%</div>
                    <div class="about-stat-label">رضا العملاء</div>
                </div>
                <div>
                    <div class="about-stat-num">50K+</div>
                    <div class="about-stat-label">صفقة ناجحة</div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Stats -->
<section id="stats">
    <div class="stat-item">
        <div class="stat-num" data-count="10000">0</div>
        <div class="stat-label">إعلان نشط</div>
    </div>
    <div class="stat-item">
        <div class="stat-num" data-count="5000">0</div>
        <div class="stat-label">مستخدم موثوق</div>
    </div>
    <div class="stat-item">
        <div class="stat-num" data-count="50000">0</div>
        <div class="stat-label">عملية بيع ناجحة</div>
    </div>
</section>

<!-- Categories -->
<section id="categories">
    <p class="section-label" id="cats-label">— تصفح حسب الفئة</p>
    <h2 class="section-title">
        <span class="line"><span class="word">كل</span> <span class="word">ما</span> <span class="word">تحتاجه</span></span>
        <span class="line"><span class="word" style="color:var(--accent)">في</span> <span class="word">مكان</span> <span class="word">واحد</span></span>
    </h2>
    <div class="cats-orbit-wrap">
        <div class="cats-orbit-circle"></div>
        <div class="cats-grid" id="cats-grid">
            @php
                $categories = \App\Models\Category::withCount('products')->where('status',1)->orderBy('name')->take(12)->get();
            @endphp
            @forelse($categories as $i => $cat)
                <a href="{{ route('products.index') }}?category={{ $cat->id }}" class="cat-card">
                    <span class="cat-icon"><i data-lucide="tag"></i></span>
                    <div class="cat-name">{{ $cat->name }}</div>
                    <div class="cat-count">{{ $cat->products_count }} منتج</div>
                </a>
            @empty
                @foreach(['إلكترونيات','سيارات','عقارات','ملابس','أثاث','كتب','رياضة','مجوهرات','رياضة','مجوهرات','كاميرات','ساعات'] as $name)
                    <div class="cat-card">
                        <span class="cat-icon"><i data-lucide="tag"></i></span>
                        <div class="cat-name">{{ $name }}</div>
                        <div class="cat-count">0 منتج</div>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section>

<!-- Marquee Products -->
<section id="marquee-section">
    <div class="marquee-track" id="marquee">
        @php
            $marqueeProducts = \App\Models\Product::where('status',1)->with('category')->latest()->take(10)->get();
            $placeholders = [['🎮','بلايستيشن 5','4,500'],['📱','آيفون 15 برو','5,200'],['🚗','تويوتا كامري','85,000'],['💻','ماك بوك برو','12,000'],['📷','كاميرا سوني','3,800'],['⌚','ساعة أبل','2,100']];
        @endphp
        @forelse($marqueeProducts as $p)
            <a href="{{ route('products.show', $p->slug) }}" class="marquee-item" style="text-decoration:none;color:inherit">
                <div class="marquee-img">
                    @if($p->getFirstMediaUrl('images'))
                        <img src="{{ $p->getFirstMediaUrl('images') }}" alt="{{ $p->title }}" style="width:100%;height:100%;object-fit:cover" />
                    @else
                        🛍️
                    @endif
                </div>
                <div class="marquee-info">
                    <div class="marquee-title">{{ $p->title }}</div>
                    <div class="marquee-price">{{ number_format($p->price) }} ج.م</div>
                </div>
            </a>
        @empty
            @foreach($placeholders as $pl)
                <div class="marquee-item">
                    <div class="marquee-img">{{ $pl[0] }}</div>
                    <div class="marquee-info">
                        <div class="marquee-title">{{ $pl[1] }}</div>
                        <div class="marquee-price">{{ $pl[2] }} ج.م</div>
                    </div>
                </div>
            @endforeach
        @endforelse
        {{-- Duplicate for seamless loop --}}
        @forelse($marqueeProducts as $p)
            <a href="{{ route('products.show', $p->slug) }}" class="marquee-item" style="text-decoration:none;color:inherit">
                <div class="marquee-img">
                    @if($p->getFirstMediaUrl('images'))
                        <img src="{{ $p->getFirstMediaUrl('images') }}" alt="{{ $p->title }}" style="width:100%;height:100%;object-fit:cover" />
                    @else
                        🛍️
                    @endif
                </div>
                <div class="marquee-info">
                    <div class="marquee-title">{{ $p->title }}</div>
                    <div class="marquee-price">{{ number_format($p->price) }} ج.م</div>
                </div>
            </a>
        @empty
            @foreach($placeholders as $pl)
                <div class="marquee-item">
                    <div class="marquee-img">{{ $pl[0] }}</div>
                    <div class="marquee-info">
                        <div class="marquee-title">{{ $pl[1] }}</div>
                        <div class="marquee-price">{{ $pl[2] }} ج.م</div>
                    </div>
                </div>
            @endforeach
        @endforelse
    </div>
</section>

<!-- Live Auctions -->
<section id="auctions">
    <p class="section-label" id="auctions-label">— مزادات حية الآن</p>
    <h2 class="section-title">
        <span class="line"><span class="word">زايد</span> <span class="word">قبل</span></span>
        <span class="line"><span class="word" style="color:var(--accent)">فوات</span> <span class="word">الأوان</span></span>
    </h2>
    <div class="auctions-grid" id="auctions-grid">
        @php
            $auctions = \App\Models\Product::where('is_auction',true)->where('status',1)->whereNotNull('auction_ends_at')->where('auction_ends_at','>',now())->with(['user','category'])->withCount('bids')->latest()->take(6)->get();
            $auctionImgs = ['https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&q=80','https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=600&q=80','https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=600&q=80'];
        @endphp
        @forelse($auctions as $i => $product)
            <div class="auction-card">
                <div class="auction-img" style="padding:0;overflow:hidden">
                    @if($product->getFirstMediaUrl('images'))
                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->title }}" style="width:100%;height:100%;object-fit:cover" />
                    @else
                        <img src="{{ $auctionImgs[$i % 3] }}" alt="{{ $product->title }}" style="width:100%;height:100%;object-fit:cover" />
                    @endif
                    <div class="auction-badge">🔥 {{ $product->bids_count }} مزايد</div>
                </div>
                <div class="auction-body">
                    <div class="auction-title">{{ $product->title }}</div>
                    <div class="auction-meta">
                        <div class="auction-price">{{ number_format($product->current_bid ?? $product->starting_price ?? $product->price) }} ج.م</div>
                        <div class="auction-timer">
                            ⏱
                            <span x-data="{t:'--:--:--',i:null}" x-init="i=setInterval(()=>{let d={{ $product->auction_ends_at->getTimestamp() }}*1000-Date.now();if(d<0){t='انتهى';clearInterval(i);return;}let h=Math.floor(d/3600000),m=Math.floor((d%3600000)/60000),s=Math.floor((d%60000)/1000);t=String(h).padStart(2,'0')+':'+String(m).padStart(2,'0')+':'+String(s).padStart(2,'0')},1000)" x-text="t" defer></span>
                        </div>
                    </div>
                    <a href="{{ route('products.show', $product->slug) }}" class="auction-btn">زايد الآن</a>
                </div>
            </div>
        @empty
            @foreach([['ساعة رولكس الذهبية','https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&q=80','45,000','02:14:33'],['عطر نيش نادر','https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=600&q=80','1,200','05:30:00'],['حذاء نايك أورجينال','https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=600&q=80','850','01:05:22']] as $demo)
                <div class="auction-card">
                    <div class="auction-img" style="padding:0;overflow:hidden">
                        <img src="{{ $demo[1] }}" alt="{{ $demo[0] }}" style="width:100%;height:100%;object-fit:cover" />
                        <div class="auction-badge">🔥 مزاد حي</div>
                    </div>
                    <div class="auction-body">
                        <div class="auction-title">{{ $demo[0] }}</div>
                        <div class="auction-meta">
                            <div class="auction-price">{{ $demo[2] }} ج.م</div>
                            <div class="auction-timer">⏱ {{ $demo[3] }}</div>
                        </div>
                        <a href="{{ route('login') }}" class="auction-btn">زايد الآن</a>
                    </div>
                </div>
            @endforeach
        @endforelse
    </div>
</section>

<!-- CTA -->
<section id="cta">
    <h2 class="cta-title" id="cta-title">
        <span class="line"><span class="word">جاهز</span> <span class="word">تبدأ</span></span>
        <span class="line"><span class="word" style="color:var(--accent)">رحلتك؟</span></span>
    </h2>
    <div id="cta-btns" style="opacity:0;display:flex;gap:1.5rem;justify-content:center;flex-wrap:wrap;margin-top:1rem">
        @auth
            <a href="{{ route('products.create') }}" class="btn-primary cta-btn-big">أضف إعلانك الأول ←</a>
        @else
            <a href="{{ route('register') }}" class="btn-primary cta-btn-big">سجل مجاناً ←</a>
            <a href="{{ route('products.index') }}" class="btn-outline cta-btn-big cta-btn-shimmer">تصفح المنتجات</a>
        @endauth
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-logo">مزادي ✦</div>
    <div class="footer-copy">© {{ date('Y') }} جميع الحقوق محفوظة — صُنع بـ ❤️</div>
</footer>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
lucide.createIcons();
gsap.registerPlugin(ScrollTrigger);

// ── Intro Sequence ───────────────────────────────────────
(function runIntro(){
    const intro = document.getElementById('intro');
    const brand = document.querySelector('#intro-brand span');
    const sub   = document.getElementById('intro-sub');
    const line  = document.getElementById('intro-line');
    const cats  = document.querySelectorAll('.intro-cat');
    const tl    = gsap.timeline();

    tl.to(brand,{y:'0%',duration:.9,ease:'power4.out'})
      .to(sub,{opacity:1,y:0,duration:.6,ease:'power3.out'},'-=.2')
      .to(line,{width:'300px',duration:.5,ease:'power2.inOut'},'-=.2')
      .to(cats,{opacity:1,y:0,scale:1,duration:.35,stagger:.07,ease:'back.out(1.5)'},'-=.1')
      .to({},{duration:.6})
      .to(cats,{opacity:0,y:-15,scale:.85,duration:.3,stagger:.04,ease:'power2.in'})
      .to([sub,line],{opacity:0,duration:.3,ease:'power2.in'},'-=.25')
      .to(brand,{y:'-110%',duration:.6,ease:'power4.in'},'-=.2')
      .to(intro,{yPercent:-100,duration:.9,ease:'power4.inOut'},'-=.1')
      .call(()=>{
          document.body.classList.remove('intro-active');
          intro.style.display='none';
          runPageAnimations();
      });
})();

function runPageAnimations(){

    // ── Scroll Progress Bar ──────────────────────────────
    gsap.to('#scroll-bar',{
        width:'100%', ease:'none',
        scrollTrigger:{trigger:'body',start:'top top',end:'bottom bottom',scrub:.3}
    });

    // ── Cursor ──────────────────────────────────────────
    const cursor=document.getElementById('cursor'),follower=document.getElementById('cursor-follower');
    let mx=0,my=0,fx=0,fy=0;
    document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;gsap.to(cursor,{x:mx,y:my,duration:.08})});
    (function loop(){fx+=(mx-fx)*.1;fy+=(my-fy)*.1;gsap.set(follower,{x:fx,y:fy});requestAnimationFrame(loop)})();
    document.querySelectorAll('a,button').forEach(el=>{
        el.addEventListener('mouseenter',()=>gsap.to(follower,{scale:2.5,borderColor:'rgba(200,169,110,.7)',duration:.3}));
        el.addEventListener('mouseleave',()=>gsap.to(follower,{scale:1,borderColor:'rgba(200,169,110,.4)',duration:.3}));
    });

    // ── Magnetic Buttons ────────────────────────────────
    document.querySelectorAll('.btn-primary,.btn-outline,.nav-cta').forEach(btn=>{
        btn.addEventListener('mousemove',e=>{
            const r=btn.getBoundingClientRect();
            const dx=(e.clientX-r.left-r.width/2)*.35;
            const dy=(e.clientY-r.top-r.height/2)*.35;
            gsap.to(btn,{x:dx,y:dy,duration:.4,ease:'power2.out'});
        });
        btn.addEventListener('mouseleave',()=>gsap.to(btn,{x:0,y:0,duration:.6,ease:'elastic.out(1,.4)'}));
    });

    // ── WebGL ────────────────────────────────────────────
    (function(){
        const canvas=document.getElementById('webgl-canvas'),gl=canvas.getContext('webgl');
        if(!gl)return;
        const resize=()=>{canvas.width=innerWidth;canvas.height=innerHeight;gl.viewport(0,0,canvas.width,canvas.height)};
        resize();addEventListener('resize',resize);
        const vs=`attribute vec2 p;void main(){gl_Position=vec4(p,0,1);}`;
        const fs=`precision mediump float;uniform float t;uniform vec2 r;void main(){vec2 uv=gl_FragCoord.xy/r;float d=length(uv-vec2(.5));float g=sin(d*8.-t*.8)*.5+.5;float b=sin(uv.x*6.+t*.5)*sin(uv.y*6.-t*.3)*.5+.5;gl_FragColor=vec4(g*.08,b*.05,g*.12,1.);}`;
        const sh=(type,src)=>{const s=gl.createShader(type);gl.shaderSource(s,src);gl.compileShader(s);return s};
        const prog=gl.createProgram();gl.attachShader(prog,sh(gl.VERTEX_SHADER,vs));gl.attachShader(prog,sh(gl.FRAGMENT_SHADER,fs));gl.linkProgram(prog);gl.useProgram(prog);
        const buf=gl.createBuffer();gl.bindBuffer(gl.ARRAY_BUFFER,buf);gl.bufferData(gl.ARRAY_BUFFER,new Float32Array([-1,-1,1,-1,-1,1,1,1]),gl.STATIC_DRAW);
        const loc=gl.getAttribLocation(prog,'p');gl.enableVertexAttribArray(loc);gl.vertexAttribPointer(loc,2,gl.FLOAT,false,0,0);
        const tL=gl.getUniformLocation(prog,'t'),rL=gl.getUniformLocation(prog,'r');
        const s=Date.now();
        (function draw(){gl.uniform1f(tL,(Date.now()-s)/1000);gl.uniform2f(rL,canvas.width,canvas.height);gl.drawArrays(gl.TRIANGLE_STRIP,0,4);requestAnimationFrame(draw)})();
    })();

    // ── Hero Background Slider ───────────────────────────
    const slides = document.querySelectorAll('.slide');
    const dots   = document.querySelectorAll('.slide-dot');
    const numEl  = document.getElementById('slide-num');
    let current  = 0, paused = false;

    gsap.set(slides,{opacity:0,scale:1.08});
    gsap.set(slides[0],{opacity:.62});
    gsap.to(slides[0],{scale:1,duration:7,ease:'power1.out'});

    function goToSlide(next){
        if(next===current)return;
        const prev=current; current=next;
        gsap.set(slides[next],{zIndex:2,scale:1.08,opacity:0});
        gsap.set(slides[prev],{zIndex:1});
        gsap.to(slides[next],{opacity:.62,duration:1.6,ease:'power2.inOut'});
        gsap.to(slides[next],{scale:1,duration:7,ease:'power1.out'});
        gsap.to(slides[prev],{opacity:0,duration:1.6,ease:'power2.inOut',onComplete:()=>gsap.set(slides[prev],{zIndex:0})});
        dots.forEach((d,i)=>d.classList.toggle('active',i===next));
        numEl.textContent=String(next+1).padStart(2,'0')+' / '+String(slides.length).padStart(2,'0');
    }

    let elapsed=0;
    gsap.ticker.add((_,dt)=>{
        if(paused)return;
        elapsed+=dt/1000;
        if(elapsed>=4.5){elapsed=0;goToSlide((current+1)%slides.length);}
    });
    dots.forEach((d,i)=>d.addEventListener('click',()=>{elapsed=0;goToSlide(i);}));
    const heroEl=document.getElementById('hero');
    heroEl.addEventListener('mouseenter',()=>paused=true);
    heroEl.addEventListener('mouseleave',()=>{paused=false;elapsed=0;});

    // ── Text Scramble Helper ─────────────────────────────
    const chars='ABCDEFGHIJKLMNOPQRSTUVWXYZابتثجحخدذرزسشصضطظعغفقكلمنهوي';
    function scramble(el, finalText, duration=1.2){
        let frame=0, total=Math.round(duration*60);
        const tick=()=>{
            let out='';
            for(let i=0;i<finalText.length;i++){
                if(frame/total > i/finalText.length){
                    out+=finalText[i];
                } else {
                    out+=chars[Math.floor(Math.random()*chars.length)];
                }
            }
            el.textContent=out;
            if(frame<total){frame++;requestAnimationFrame(tick);}
            else el.textContent=finalText;
        };
        tick();
    }

    // ── Hero Text — stagger reveal + scramble on tag ─────
    const htl=gsap.timeline({defaults:{ease:'power4.out'}});
    htl.to('#hero-tag',{opacity:1,y:0,duration:.7,onComplete:()=>{
            const tagText=document.querySelector('#hero-tag');
            const orig=tagText.textContent.trim();
            scramble(tagText,orig,.8);
        }})
       .to('.rw span',{y:'0%',opacity:1,duration:1,stagger:.12,ease:'power4.out'},'-=.3')
       .to('#hero-bottom',{opacity:1,y:0,duration:.9},'-=.5')
       .to('#scroll-ind',{opacity:1,duration:.5},'-=.3');

    // ── Nav fade in ──────────────────────────────────────
    gsap.from('nav',{y:-30,opacity:0,duration:.8,ease:'power3.out',delay:.2});

    // ── About Section — circle drops in on scroll ────────
    const circle = document.getElementById('about-circle');
    const aboutSlides = document.querySelectorAll('.about-slide');
    const aboutDots   = document.querySelectorAll('.about-dot');
    let aboutCurrent  = 0;

    // Scroll-driven: circle falls from above into place
    gsap.to(circle, {
        y: 0, opacity: 1,
        ease: 'power3.out',
        scrollTrigger: {
            trigger: '#about',
            start: 'top 80%',
            end:   'top 30%',
            scrub: 1.2,
        }
    });

    // Text reveals after circle lands
    ScrollTrigger.create({
        trigger: '#about',
        start: 'top 40%',
        once: true,
        onEnter: () => {
            const atl = gsap.timeline({defaults:{ease:'power4.out'}});
            atl.to('#about-tag',   {opacity:1, y:0, duration:.6})
               .to('.about-title .word', {y:'0%', duration:1, stagger:.1}, '-=.3')
               .to('#about-body',  {opacity:1, y:0, duration:.7}, '-=.5')
               .to('#about-stats', {opacity:1, y:0, duration:.6}, '-=.4')
               .to('#about-circle-label', {opacity:1, y:0, duration:.5}, '-=.4');
        }
    });

    // About carousel — auto-advance every 3s
    function goAboutSlide(next) {
        if(next === aboutCurrent) return;
        const prev = aboutCurrent;
        aboutCurrent = next;

        gsap.to(aboutSlides[prev], {opacity:0, scale:1.06, duration:1, ease:'power2.inOut'});
        gsap.fromTo(aboutSlides[next],
            {opacity:0, scale:1.06},
            {opacity:1, scale:1,   duration:1.2, ease:'power2.inOut'}
        );
        aboutDots.forEach((d,i) => d.classList.toggle('active', i===next));
    }

    let aboutElapsed = 0;
    gsap.ticker.add((_, dt) => {
        aboutElapsed += dt / 1000;
        if(aboutElapsed >= 3) {
            aboutElapsed = 0;
            goAboutSlide((aboutCurrent + 1) % aboutSlides.length);
        }
    });

    aboutDots.forEach((d,i) => d.addEventListener('click', () => {
        aboutElapsed = 0;
        goAboutSlide(i);
    }));

    // Slow Ken Burns on first about slide
    gsap.to(aboutSlides[0], {scale:1, duration:6, ease:'power1.out'});

    // ── Stats — count up + line draw ─────────────────────
    gsap.utils.toArray('.stat-item').forEach((el,i)=>{
        gsap.to(el,{opacity:1,y:0,duration:.8,delay:i*.2,
            scrollTrigger:{trigger:'#stats',start:'top 80%'}});
        const num=el.querySelector('.stat-num'),target=+num.dataset.count;
        ScrollTrigger.create({trigger:'#stats',start:'top 80%',once:true,onEnter:()=>{
            gsap.to({val:0},{val:target,duration:2.5,ease:'power3.out',onUpdate:function(){
                num.textContent=Math.round(this.targets()[0].val).toLocaleString('ar-EG')+'+'
            }})
        }});
    });

    // ── Section labels — slide in from left ──────────────
    document.querySelectorAll('.section-label').forEach(el=>{
        gsap.fromTo(el,{opacity:0,x:-30},{opacity:1,x:0,duration:.7,ease:'power3.out',
            scrollTrigger:{trigger:el,start:'top 88%'}});
    });

    // ── Section title words ──────────────────────────────
    document.querySelectorAll('.section-title .word').forEach(w=>{
        gsap.to(w,{y:'0%',duration:1.1,ease:'power4.out',
            scrollTrigger:{trigger:w,start:'top 92%'}});
    });

    // ── Line accents draw ────────────────────────────────
    document.querySelectorAll('.line-accent').forEach(el=>{
        gsap.to(el,{width:'120px',duration:.8,ease:'power2.out',
            scrollTrigger:{trigger:el,start:'top 90%'}});
    });

    // ── Category bubbles — scatter with collision avoidance ──
    const catCards = gsap.utils.toArray('.cat-card');
    const container = document.getElementById('cats-grid');

    // Sizes: mix of big, medium, small
    const sizes = [130, 110, 100, 120, 95, 115, 105, 90, 125, 100, 110, 95];

    function placeBubbles() {
        if(window.innerWidth <= 768) return; // grid layout on mobile
        const W = container.offsetWidth;
        const H = container.offsetHeight;
        const placed = [];

        catCards.forEach((card, i) => {
            const size = sizes[i % sizes.length];
            card.style.width  = size + 'px';
            card.style.height = size + 'px';

            let x, y, tries = 0, ok = false;
            while (!ok && tries < 200) {
                tries++;
                x = Math.random() * (W - size);
                y = Math.random() * (H - size);
                const cx = x + size / 2, cy = y + size / 2;
                ok = placed.every(p => {
                    const dx = cx - p.cx, dy = cy - p.cy;
                    return Math.sqrt(dx*dx + dy*dy) > (size/2 + p.r + 12);
                });
            }
            placed.push({ cx: x + size/2, cy: y + size/2, r: size/2 });
            card.style.left = x + 'px';
            card.style.top  = y + 'px';
        });
    }

    placeBubbles();
    window.addEventListener('resize', placeBubbles);

    // Animate in from random directions
    const directions = [
        {x:-200,y:-200},{x:0,y:-250},{x:200,y:-200},
        {x:-250,y:0},                  {x:250,y:0},
        {x:-200,y:200},{x:0,y:250},{x:200,y:200},
        {x:-180,y:-180},{x:180,y:-180},{x:-180,y:180},{x:180,y:180}
    ];
    catCards.forEach((card, i) => {
        const dir = directions[i % directions.length];
        gsap.fromTo(card,
            {opacity:0, x:dir.x, y:dir.y, scale:.5, rotate:(i%2===0?-20:20)},
            {opacity:1, x:0, y:0, scale:1, rotate:0,
             duration:1.1, delay:i*.07,
             ease:'back.out(1.6)',
             scrollTrigger:{trigger:'#cats-grid', start:'top 80%', once:true}
            }
        );
    });

    // Gentle float animation per bubble
    catCards.forEach((card, i) => {
        gsap.to(card, {
            y: `+=${6 + (i % 4) * 3}`,
            duration: 2.5 + (i % 5) * 0.4,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
            delay: i * 0.15,
        });
    });

    // ── Marquee — CSS only, no JS cloning needed ────────
    // Items are already duplicated in HTML for seamless loop

    // ── Auction cards — clip reveal ──────────────────────
    gsap.utils.toArray('.auction-card').forEach((card,i)=>{
        gsap.fromTo(card,
            {opacity:0,y:60,clipPath:'inset(100% 0 0 0)'},
            {opacity:1,y:0,clipPath:'inset(0% 0 0 0)',duration:.9,delay:i*.1,ease:'power4.out',
             scrollTrigger:{trigger:'#auctions-grid',start:'top 82%'}}
        );
    });

    // ── Marquee section — always visible ────────────────
    gsap.set('#marquee-section', {opacity:1});

    // ── CTA — big text reveal ────────────────────────────
    document.querySelectorAll('#cta-title .word').forEach(w=>{
        gsap.to(w,{y:'0%',duration:1.4,ease:'power4.out',
            scrollTrigger:{trigger:'#cta',start:'top 82%'}});
    });
    gsap.to('#cta-btns',{opacity:1,y:0,duration:.9,delay:.5,ease:'power3.out',
        scrollTrigger:{trigger:'#cta',start:'top 78%'}});

    // ── Footer slide up ──────────────────────────────────
    gsap.from('footer',{opacity:0,y:30,duration:.8,ease:'power3.out',
        scrollTrigger:{trigger:'footer',start:'top 95%'}});

    // ── Scroll-driven parallax on section backgrounds ────
    gsap.utils.toArray('#categories,#auctions').forEach(sec=>{
        gsap.fromTo(sec,{backgroundPositionY:'0%'},{backgroundPositionY:'30%',ease:'none',
            scrollTrigger:{trigger:sec,start:'top bottom',end:'bottom top',scrub:true}});
    });

    // ── Mobile: disable bubble animations, use grid ──────
    if(window.innerWidth <= 768) {
        gsap.utils.toArray('.cat-card').forEach(card => {
            gsap.killTweensOf(card);
            card.style.opacity = '1';
            card.style.transform = 'none';
        });
    }
}

// ── Mobile Menu ──────────────────────────────────────────
const hamburger = document.getElementById('nav-hamburger');
const mobileMenu = document.getElementById('nav-mobile');
function closeMobileMenu(){
    hamburger.classList.remove('open');
    mobileMenu.classList.remove('open');
    document.body.style.overflow='';
}
hamburger.addEventListener('click',()=>{
    const isOpen = hamburger.classList.toggle('open');
    mobileMenu.classList.toggle('open', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
});
mobileMenu.addEventListener('click', e => { if(e.target === mobileMenu) closeMobileMenu(); });

// ── Welcome Nav User Dropdown ────────────────────────────
function toggleWlcMenu(){
    const dd  = document.getElementById('wlc-user-dropdown');
    const chv = document.getElementById('wlc-chevron');
    if(!dd) return;
    const open = dd.style.display === 'block';
    dd.style.display  = open ? 'none' : 'block';
    if(chv) chv.style.transform = open ? 'rotate(0deg)' : 'rotate(180deg)';
}
document.addEventListener('click', e => {
    const btn = document.getElementById('wlc-user-btn');
    const dd  = document.getElementById('wlc-user-dropdown');
    if(btn && dd && !btn.contains(e.target) && !dd.contains(e.target)){
        dd.style.display = 'none';
        const chv = document.getElementById('wlc-chevron');
        if(chv) chv.style.transform = 'rotate(0deg)';
    }
});
</script>
</body>
</html>
