{{--
    Global SEO Meta Component
    Handles meta tags, Open Graph, and Structured Data
--}}
@props([
    'title' => null,
    'description' => 'Merry Meals - Providing nutritious meals and compassionate care to those who need it most. Meals on wheels service for the community.',
    'image' => asset('/images/MerryMealLogo-02.png'),
    'type' => 'website',
    'canonical' => url()->current(),
])

@php
    $siteName = config('app.name', 'Merry Meals');
    $fullTitle = $title ? "{$title} | {$siteName}" : "{$siteName} | Meals on Wheels";
@endphp

<!-- Primary Meta Tags -->
<title>{{ $fullTitle }}</title>
<meta name="title" content="{{ $fullTitle }}">
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $canonical }}">
<meta property="twitter:title" content="{{ $fullTitle }}">
<meta property="twitter:description" content="{{ $description }}">
<meta property="twitter:image" content="{{ $image }}">

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NonprofitOrganization",
  "name": "{{ $siteName }}",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('/images/MerryMealLogo-02.png') }}",
  "description": "{{ $description }}",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Denpasar",
    "addressRegion": "Bali",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+62-xxx-xxxx-xxxx",
    "contactType": "customer service"
  }
}
</script>
