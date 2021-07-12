@foreach ($categories as $category)
                <label> <input type="checkbox" name="categories[]" id="{{ $category->id }}"
                        value="{{ $category->id }}"
                        {{ in_array($category->id, $productCategories) ? 'checked' : '' }}>
                    {{ $category->name }} </label>
                @forelse ($category->categories as $item)
                    <div class="container">
                        <label class="">
                            <input type="checkbox" name="categories[]" id="{{ $item->id }}"
                                value="{{ $item->id }}"
                                {{ in_array($item->id, $productCategories) ? 'checked' : '' }}>
                            {{ $item->name }}
                        </label>
                        @forelse ($item->categories as $datum)
                            <div class="container">
                                <label>
                                    <input type="checkbox" name="categories[]" id="{{ $datum->id }}"
                                        value="{{ $datum->id }}"
                                        {{ in_array($datum->id, $productCategories) ? 'checked' : '' }}>
                                    {{ $datum->name }} </label>
                            </div>
                        @empty
                @endforelse
            </div>
        @empty
        @endforelse
        @endforeach
