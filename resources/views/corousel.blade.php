@section('content')
<style>
    .testimonial-card {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        text-align: center;
    }

    .testimonial-card img {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        margin-bottom: 16px;
    }
</style>
<div class="w-full py-24 lg:py-32" id="testimonials">
    <div class="grid gap-10">
        <div
            class="flex w-full flex-col items-center justify-center px-4 text-center md:px-6 lg:flex-row lg:justify-between lg:text-left">
            <div class="flex flex-col items-center lg:items-start">
                <h2
                    class="flex flex-col -space-y-4 text-4xl font-bold leading-tight tracking-tighter sm:text-5xl md:text-5xl md:leading-tight lg:text-6xl lg:leading-tight">
                    My Testimonials
                </h2>
            </div>
            <p class="mt-4 hidden text-gray-500 dark:text-gray-400 lg:mt-0 lg:block lg:w-[35%]">
                Here are some of my testimonials where clients and colleagues share their experiences of working with
                me.
                <br>
                <b>Note: The images used in this carousel are sourced from Unsplash.</b>
            </p>
        </div>

        <div class="relative flex flex-col items-center justify-center gap-4 overflow-hidden">
            <!-- First Carousel -->
            <div class="swiper-container w-full">
                <div class="swiper-wrapper">
                    @foreach ($firstRow as $testimonial)
                        <div class="swiper-slide md:basis-1/2 xl:basis-1/3 2xl:basis-1/4">
                            <div class="h-full p-1">
                                <div class="testimonial-card">
                                    <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}">
                                    <h3>{{ $testimonial['name'] }}</h3>
                                    <p>{{ $testimonial['username'] }}</p>
                                    <p>{{ $testimonial['testimonial'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Second Carousel -->
            <div class="swiper-container w-full">
                <div class="swiper-wrapper">
                    @foreach ($secondRow as $testimonial)
                        <div class="swiper-slide md:basis-1/2 xl:basis-1/3 2xl:basis-1/4">
                            <div class="h-full p-1">
                                <div class="testimonial-card">
                                    <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}">
                                    <h3>{{ $testimonial['name'] }}</h3>
                                    <p>{{ $testimonial['username'] }}</p>
                                    <p>{{ $testimonial['testimonial'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div
                class="pointer-events-none absolute inset-y-0 left-0 w-1/4 bg-linear-to-r from-white dark:from-background">
            </div>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-linear-to-l from-white dark:from-background">
            </div>
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper1 = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            spaceBetween: 10,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        });

        const swiper2 = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
                reverseDirection: true,
            },
            slidesPerView: 1,
            spaceBetween: 10,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        });
    });
</script>
@endsection