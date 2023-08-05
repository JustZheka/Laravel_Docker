<!DOCTYPE html>
<html lang="ru">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link href="{{asset('css/style.js')}}" rel="stylesheet">
        @vite('resources/css/style.css')
        @vite('resources/js/index.js')
    </head>
    <body>
        <main>
            <div id="program">
                <form id="add" method="POST" action="{{ route('Items.add') }}">
                    @csrf
                    <input 
                     id="mainInput"
                     name="inp"
                     class="form-control-lg"
                     type="text" 
                     placeholder="Please input something here" />
                     <button name="addBtn" class="btn btn-primary">Добавить</button>
                     @error('inp')
                        <div class="alert alert-danger">
                            The text must not be empty or consist of spaces
                        </div>
                     @enderror
                </form>
                <form class="Sort">
                    @csrf
                    <input type="radio" id="NumAsc" name="SortType" value="NumAscending" @if ($sortType->Type == "NumAsc") checked @endif>
                    <label for="NumAsc">По возрастанию индекса</label>

                    <input type="radio" id="NumDes" name="SortType" value="NumDescending" @if($sortType->Type == "NumDes") checked @endif>
                    <label for="NumDes">По убыванию индекса</label>

                    <input type="radio" id="AlphAsc" name="SortType" value="AlphAscending" @if($sortType->Type == "AlphAsc") checked @endif>
                    <label for="AlphAsc">В алфавитном порядке по возрастанию</label>

                    <input type="radio" id="AlphDes" name="SortType" value="AlphDescending" @if($sortType->Type == "AlphDes") checked @endif>
                    <label for="AlphDes">В алфавитном порядке по убыванию</label>
                </form>
                <div class="list-status">
                    @if (count($elements) >= 1)
                        Список:
                    @else
                        Список пуст
                    @endif
                    <ul class="list-group-item-info">
                        @foreach ($elements as $element)
                            <li class="list">
                                <span>{{ $element->order_num}} -</span>
                                @if (!$element->edit_mode)
                                    <span>
                                        <span>{{ $element->content }}</span>
                                        <form method="post" action="{{ route('Items.edit', $element->id) }}" style="display: inline">
                                            @csrf
                                            <button class="btn btn-primary" data-action="Edit">Редактировать</button>
                                        </form>
                                        <form method="post" action="{{ route('Items.delete', $element->id) }}" style="display: inline">
                                            @csrf
                                            <button name="deleteBtn" class="btn btn-danger" data-action="Delete">X</button>
                                        </form>
                                    </span>
                                @else
                                    <span>
                                        <form method="post" action="{{ route('Items.ok', $element->id) }}" style="display: inline">
                                            @csrf
                                            <input 
                                                class="form-text-sm"
                                                name="editInp"
                                                type="text" 
                                                value="{{$element->content}}"
                                                placeholder="Please edit here" />
                                            <button class="btn btn-success" data-action="Edit">OK</button>
                                        </form>
                                        <form method="post" action="{{ route('Items.cancel', $element->id) }}" style="display: inline">
                                                @csrf
                                            <button class="btn btn-danger" data-action="Delete">Отмена</button>
                                        </form>
                                        @error('editInp')
                                            <div class="alert alert-danger">
                                                The text must not be empty or consist of spaces
                                            </div>
                                        @enderror
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/vue@next"></script>
    </body>
</html>