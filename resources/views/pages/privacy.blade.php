@extends('layout.app')
@section('title', __('Privacy'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/Privacy.css') }}">
@endpush
@section('content')
<style>
    .hero {
    background: url("/storage/Privacy policy/7d2a68406b519c97d9beeadc420ce13d.jpg") center/cover no-repeat;
    padding-top: 100px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
}
</style>
<div class="d">  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h2>Privacy Policy</h2>
      <p>Home // <span>Privacy Policy</span></p>
    </div>
  </section></div>
  <!-- Hero Section -->
  <div class="container hero-section">
    <div class="row align-items-center">
      <div class="col-md-6 image-container">
          <img src="{{ asset('storage/Privacy policy/e4c7cff38678f9e1b7158ac75c6143c5.jpg') }}" alt="Donation Image" height="350px">
        <!-- زر Scroll مثل الصورة -->
        <button class="scroll-btn" onclick="scrollToContent()">
          <i class="fa-solid fa-arrow-down"></i> Scroll
        </button>
      </div>
      <div class="col-md-6 hero-text">
        <h5><b>We keep our supporters’ info safe and private</b></h5>
        <p>
          Your donation supports education and basic needs for families in need. Each contribution helps improve lives and bring hope to communities. Your support is valued and makes a real difference every day
        </p>
        <p>
          We are committed to transparency and accountability. Every donation is tracked carefully to ensure it reaches those who need it most. Your trust is important to us, and we strive to use every contribution responsibly
        </p>
      </div>
    </div>
  </div>

  <!-- Content Section -->
  <div id="short-version" class="content-section">
    <h3>The Long Version</h3>
    <p>
     Life in Gaza is challenging for thousands of families. Continuous blockades, economic instability, and recurring crises have left many households struggling to meet basic needs. Families face difficulties in accessing food, clean water, and shelter, making daily life uncertain.
    </p>
    <p>
    Education remains a major challenge. Many children face disrupted schooling due to lack of resources, overcrowded classrooms, and frequent interruptions. Donations help provide essential school supplies, support teachers, and create safe learning environments for young students
    </p>
    <p>
      Healthcare is another critical concern. Hospitals and clinics often lack essential medicines and equipment. Contributions from donors ensure that medical care is available for children, the elderly, and families in urgent need, reducing suffering and saving lives.
    </p>
     <p>
     Basic necessities such as food, clothing, and hygiene products are scarce for many families. Donations allow organizations to distribute aid efficiently, giving families the support they need to survive and maintain dignity in extremely difficult circumstances.
    </p>
     <p>
      Every donation makes a tangible difference. By supporting local initiatives, donors provide meals, clean water, educational tools, and health services directly to the people who need them most. This ensures that assistance reaches its intended recipients quickly and effectively.
    </p>
     <p>
      Access to electricity and basic utilities is extremely limited. Power outages are frequent, and many homes rely on backup generators that cannot run continuously. Water supply is also a major concern, with families depending on limited and often unsafe sources. Donations help provide emergency fuel, water tanks, and solar solutions to improve living conditions.
    </p>
       <p>
      Life in Gaza places immense psychological stress on families. Children and adults alike face trauma from conflict and uncertainty. Donations contribute to programs that provide counseling, recreational activities, and safe spaces, helping families build resilience and maintain hope for a better future.
    </p>

  </div>
   <div id="short-version" class="content-section">
    <h3>The Short Version</h3>
    <p>
In Gaza, every sunrise begins with resilience. Families adapt to restrictions that shape even the smallest details of life.    </p>
    <p>
Laughter mixes with worry. Children dream of safe playgrounds while learning in crowded classrooms.    </p>
    <p>
Limited power and scarce water turn daily routines into constant challenges for every household.    </p>
     <p>
Long lines for bread and supplies reflect the patience of a people determined to endure.    </p>
     <p>
Doctors work tirelessly with limited tools, saving lives against overwhelming odds.    </p>
     <p>
A small contribution can mean warmth, medicine, or food for a struggling family.    </p>

 <p>
Every family in Gaza carries a story of sacrifice, faith, and unwavering resilience.   </p>
 <p>
With every act of kindness, hope is reborn, lighting the way for a stronger tomorrow.   </p>
 <p>
Students study by candlelight, carrying dreams of building a better future. </p>
 <p>
Every voice in Gaza tells the world: we are alive, we endure, and we deserve dignity.   </p>
 <p>
Mothers and daughters keep families strong, balancing survival with compassion.  </p>
  </div>
  </section>
  @include('sections.contact')
  @endsection
