<table class="table align-middle mb-0">
    <thead class="bg-light">
        <tr>
            <th>កូដតេស្ត</th>
            <th>ឈ្មោះតេស្តពិសោធន៍</th>
            <th>កម្រិតធម្មតា (Normal Range)</th>
            <th>ខ្នាត (Unit)</th>
            <th>តម្លៃ ($)</th>
            <th class="text-right">សកម្មភាព</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($labTests as $test)
            <tr>
                <td class="font-weight-bold text-dark">{{ $test->test_code ?? 'T-' . $test->test_id }}</td>
                <td>
                    <div class="font-weight-bold text-primary">{{ $test->test_name }}</div>
                </td>
                <td>
                    <span class="badge badge-light border text-dark">{{ $test->normal_range ?? '—' }}</span>
                </td>
                <td>
                    <span class="text-muted">{{ $test->unit ?? '—' }}</span>
                </td>
                <td class="font-weight-bold text-success">${{ number_format($test->price, 2) }}</td>
                <td class="text-right">
                    <div class="dropup">

                        {{-- Action Button --}}
                        <button type="button" class="btn btn-sm btn-light action-menu-btn" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="សកម្មភាព">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div class="dropdown-menu dropdown-menu-right shadow-sm">

                            {{-- Edit --}}
                            <button type="button" class="dropdown-item btn-edit-test" data-id="{{ $test->test_id }}"
                                data-name="{{ $test->test_name }}" data-code="{{ $test->test_code }}"
                                data-range="{{ $test->normal_range }}" data-unit="{{ $test->unit }}"
                                data-price="{{ $test->price }}">
                                <i class="fas fa-edit mr-2 text-primary"></i>
                                កែប្រែ
                            </button>

                            {{-- Delete --}}
                            <form action="{{ route('lab.tests.destroy', $test->test_id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <!-- <button type="submit" class="dropdown-item"
                                        onclick="return confirm('តើអ្នកពិតជាចង់លុបតេស្តនេះមែនទេ?');">
                                        <i class="fas fa-trash-alt mr-2 text-danger"></i>
                                        លុប
                                    </button> -->
                                <button type="button" class="dropdown-item text-danger btn-delete-test"
                                    data-id="{{ $test->test_id }}" data-name="{{ $test->test_name }}" data-toggle="modal"
                                    data-target="#modalDeleteTest">

                                    <i class="fas fa-trash-alt mr-2"></i>
                                    លុប
                                </button>
                            </form>


                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                    <i class="fas fa-microscope fa-3x mb-3 text-muted opacity-50"></i>
                    <p class="font-weight-bold mb-1">មិនទាន់មានបញ្ជីតេស្តពិសោធន៍ទេ</p>
                    <small>សូមបន្ថែមតេស្តពិសោធន៍ថ្មីក្នុងកាតាឡុក</small>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
