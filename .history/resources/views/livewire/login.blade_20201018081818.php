<div>
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
                <hr/>
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('error'))
                <hr/>
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <form>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Username :</label>
                    <input type="text" wire:model.lazy="email" class="form-control" autofocus>
                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="bold">Kata Sandi :</label>
                    <input type="password" wire:model.lazy="password" class="form-control">
                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-bold">Kata Sandi :</label>
                    <select name="thajaran" id="thajaran" wire:model="thterpilih" class="form-control">
                        @foreach ($thajaran as $th)
                            <option value="{{ $th->kode }}" {{ $th->status == 1 ? "selected" : "" }}>{{ $th->keterangan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button class="btn text-white btn-success" wire:click.prevent="login">Masuk</button>
            </div><br>
            <div class="col-md-12 text-center">
                <small>Copyright &copy; 2020 Anoda.web.id</small>
            </div><br>
            @php
                function solution($str) {
                    if(strlen($str) % 2 != 0){
                        $str .= "_";
                    }
                    return str_split($str, 2);
                }
                print_r(solution("abcdef"));
            @endphp
        </div>
    </form>
</div>
