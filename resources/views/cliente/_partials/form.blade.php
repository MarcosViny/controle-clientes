<fieldset class="form-group border p-3">
            <legend class="w-auto float-none px-2">Dados Pessoais</legend>
            <div id="loading">
                <div class="containerCarregando">
                    <div id="gifCarregando">
                        <img src="/images/loading.gif" alt="Carregando...">
                    </div>
                    <span class="textoCarregando display-5 text-white"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" value="{{ $cliente->nome ?? old('nome') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">E-mail:</label>
                <input type="text" name="email" id="email" value="{{ $cliente->email ?? old('email') }}" class="form-control">
            </div>
            <div class="form-group">
                    @php 
                        $generoPadrao = (!isset($cliente) && !old('genero')) ? 'checked' : '';
                    @endphp
                <label class="form-label">Sexo:</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" value="M" name="genero" id="genero_m" class="form-check-input" @if (isset($cliente) && $cliente->genero == 'M' || old('genero') == 'M') checked @endif {{ $generoPadrao }}>
                        <label for="genero_m" class="form-check-label">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" value="F" name="genero" id="genero_f" class="form-check-input" @if (isset($cliente) && $cliente->genero == 'F' || old('genero') == 'F') checked @endif>
                        <label for="genero_f" class="form-check-label">Feminino</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" id="telefone" class="form-control phone-ddd-mask" value="{{ isset($cliente->telefone) && !empty($cliente->telefone) ? formatarTelefone($cliente->telefone) : old('telefone') }}">
            </div>
        </fieldset>

        <fieldset class="form-group border p-3 mb-3">
            <legend class="w-auto float-none px-2">Endereço</legend>

            <div class="mb-3">
                <label for="cep" class="form-label">CEP:</label>
                <input type="text" name="cep" id="cep" class="form-control cep-mask" value="{{ isset($endereco->cep) && !empty($endereco->cep) ? formatarCep($endereco->cep) : old('cep') }}">
            </div>
            <div class="mb-3">
                <label for="logradouro" class="form-label">Logradouro:</label>
                <input type="text" name="logradouro" id="logradouro" class="form-control" value="{{ $endereco->logradouro ?? old('logradouro') }}" readonly>
            </div>
            <div class="mb-3">
                <label for="complemento" class="form-label">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $endereco->complemento ?? old('complemento') }}">
            </div>
            <div class="mb-3">
                <label for="bairro" class="form-label">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $endereco->bairro ?? old('bairro') }}" readonly>
            </div>
            <div class="mb-3">
                <label for="localidade" class="form-label">Localidade:</label>
                <input type="text" name="localidade" id="localidade" class="form-control" value="{{ $endereco->localidade ?? old('localidade') }}" readonly>
            </div>
            <div class="mb-3">
                <label for="uf" class="form-label">UF:</label>
                <input type="text" name="uf" id="uf" class="form-control" value="{{ $endereco->uf ?? old('uf') }}" readonly>
            </div>
        </fieldset>