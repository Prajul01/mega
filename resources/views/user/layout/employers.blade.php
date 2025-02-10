  <div class="py-3">
      <div class="container">
          <div class="swiper mySwiper">
              <div class="swiper-wrapper">
                  @foreach (App\Models\Employer::where('status', 'active')->get() as $employer)
                      <div class="swiper-slide">
                          <div class="text-center px-3 py-2">
                              <a href="{{ route('employer_detail', $employer->slug) }}" data-bs-toggle="tooltip"
                                  data-bs-placement="top" title=""
                                  data-bs-original-title="{{ $employer->company_name }}">
                                  <img src="{{ asset('storage/employer/logo' . $employer->logo) }}"
                                      alt="{{ $employer->company_name }}" class="img-fluid" width="126px">
                              </a>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>

      </div>
  </div>
