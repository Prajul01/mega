 <div class="card candidate-info new-shadow-sidebar mt-4 mt-lg-0">
     <div class="card-body p-3">
         <div class="category-card-title">
             Jobs By Categories
         </div>
         @php
             $categories = App\Models\CompanyCategory::with('jobs')
                 ->where('status', 'active')
                 ->orderBy('order_no')
                 ->get();

         @endphp
         <div class="row">
             @foreach ($categories->chunk(1) as $key => $categoryChunk)
                 <div class="col-lg-4 {{ $key != 0 ? 'mobile-none' : '' }}">
                     <div class="card job-Categories-box bg-light border-0">
                         <div class="card-body p-2">
                             <ul class="list-unstyled job-Categories-list mb-0">
                                 @foreach ($categoryChunk as $category)
                                     <li>
                                         <a href="{{ route('jobs', ['category' => $category->slug]) }}" target="_blank"
                                             class="primary-link">{{ $category->title }}
                                             <span
                                                 class="badge bg-soft-info float-end">{{ $category->jobs->count() }}</span>
                                         </a>
                                     </li>
                                 @endforeach
                             </ul>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>

     </div>
 </div>
