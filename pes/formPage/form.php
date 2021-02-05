<form method="post" id="survey-form" action="index.php">

    <div class="form-group">
        <label for="jmeno">Jméno feny:</label>
        <input type="text" name="jmeno" class="form-control" required>
        <label for="staniceFeny">Chovatelská stanice feny:</label>
        <input type="text" name="staniceFeny" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="otec">Jméno otce feny:</label>
        <input type="text" name="otec" class="form-control" required>
        <label for="staniceOtce">Chovatelská stanice otce:</label>
        <input type="text" name="staniceOtce" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="matka">Jméno matky feny:</label>
        <input type="text" name="matka" class="form-control" required>
        <label for="staniceMatky">Chovatelská stanice matky:</label>
        <input type="text" name="staniceMatky" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="vyska">Výška:</label>
        <input type="text" name="vyska" class="form-control" required>
    </div>
    
    <div class="form-group">
    <p>Barva oka:</p>
        <label>
        <input type="radio" name="barva-oka" value="0" class="input-radio">
        0 - oko černé 
        </label>
        <label>
        <input type="radio" name="barva-oka" value="1" class="input-radio">
        1 - oko černohnědé
        </label>
        <label>
        <input type="radio" name="barva-oka" value="2" class="input-radio" checked>
        2 - oko tmavě hnědé
        </label>
        <label>
        <input type="radio" name="barva-oka" value="3" class="input-radio">
        3 - oko středně hnědé
        </label>
        <label>
        <input type="radio" name="barva-oka" value="4" class="input-radio">
        4 - oko červenohnědé
        </label>
        <label>
        <input type="radio" name="barva-oka" value="5" class="input-radio">
        5 - oko světle hnědé
        </label>
        <label>
        <input type="radio" name="barva-oka" value="6" class="input-radio">
        6 - oko žlutohnědé
        </label>
    </div>

   <div class="form-group">
   <p>Skus:</p>
        <label>
        <input type="radio" name="skus" class="input-radio" value="4">
        4 - volné nůžky
        </label>  
        <label>
        <input type="radio" name="skus" class="input-radio" value="5" checked>
        5 - nůžkový
        </label>  
        <label>
        <input type="radio" name="skus" class="input-radio" value="6">
        6 - těsné nůžky
        </label>  
        <label>
        <input type="radio" name="skus" class="input-radio" value="7">
        7 - kleště
        </label>  
   </div>

    <div class="form-group">
    <p>Chybění zubů:</p>   
        <label>
        <input type="radio" class="input-checkbox" name="zuby" value="0" checked>
        0 - Plný chrup
        </label>
        <label>
        <input type="radio" class="input-checkbox" name="zuby" value="1">
        1 - Chybí premolár/y nebo molár/y
        </label>
    </div>

    <div class="form-group">
    <p>Tělesná stavba: 
    <span class="clue">(vyberte všechny možnosti)</span>
    </p>
        <label>
        <input type="hidden" class="input-checkbox" name="stavba[]" value="A" checked>
        <img src="images/checked.png" alt="checked">&nbspA - odpovídá standardu
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="B">
        B - dlouhá úzká hlava
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="C">
        C - lymfatická hlava
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="D">
        D - mělký stop
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="E">
        E - hluboký stop
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="F">
        F - vystupující tváře
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="G">
        G - otevřené pysky
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="H">
        H - vadný tvar oka
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="I">
        I - dlouhé ucho
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="J">
        J - lehké, odstávající ucho
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="K">
        K - krátký krk
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="L">
        L - vadné postavení a úhlení hrudních končetin 
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="M">
        M - nedostatečný hrudník
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="N">
        N - dlouhý, měkký hřbet
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="O">
        O - klenutý hřbet, bedra
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="P">
        P - přestavěný
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="Q">
        Q - krátká, spadající záď
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="R">
        R - krátký ocas
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="S">
        S - vadně nesený, deformovaný ocas
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="T">
        T - vadné postavení a úhlení pánevních končetin
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="U">
        U - rozevřené tlapy
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="V">
        V - vady černé barvy
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="W">
        W - světlé pálení
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="X">
        X - zakouřené pálení
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="Y">
        Y - vadné osrstění 
        </label>
        <label>
        <input type="checkbox" class="input-checkbox" name="stavba[]" value="Z">
        Z - vadné chody
        </label>
    </div>

    <div class="form-group">
    <p>Bílé znaky:</p>
        <label >
        <input type="radio" name="white" class="input-radio" value="2">
        2 - chybí některé bílé znaky 
        </label>
        <label >
        <input type="radio" name="white" class="input-radio" value="3">
        3 - většina bílých znaků méně vyjádřena 
        </label>
        <label >
        <input type="radio" name="white" class="input-radio" value="4">
        4 - typické rozložení bílých znaků, některé méně vyjádřené nebo mírně nesymetrické
        </label>
        <label >
        <input type="radio" name="white" class="input-radio" value="5" checked>
        5 - typické rozložení bílých znaků
        </label>
        <label >
        <input type="radio" name="white" class="input-radio" value="6">
        6 - typické rozložení bílých znaků, některé více vyjádřené nebo mírně nesymetrické
        </label>
        <label >
        <input type="radio" name="white" class="input-radio" value="7">
        7 - většina znaků více vyjádřena, větší asymetrie, větší bílá skvrna na šíji, bílá za koutek
        </label>
    </div>

    <div class="form-group">
    <p>Povaha:</p>
        <label>
        <input type="radio" name="povaha" class="input-radio" value=3">
        3 - nejistý, nervózní
        </label>
        <label>
        <input type="radio" name="povaha" class="input-radio" value="4">
        4 - temperamentní, lehce rozrušitelný
        </label>
        <label>
        <input type="radio" name="povaha" class="input-radio" value="5" checked>
        5 - vyrovnaný, sebejistý
        </label>
        <label>
        <input type="radio" name="povaha" class="input-radio" value="6">
        6 - klidný, ale pozorný
        </label>
        <label>
        <input type="radio" name="povaha" class="input-radio" value="7">
        7 - málo temperamentní
        </label>
        <label>
        <input type="radio" name="povaha" class="input-radio" value="8">
        8 - flegmatický
        </label>
    </div>

    <div class="form-group">
    <p>DKK:</p>
        <label >
        <input type="radio" name="dkk" class="input-radio" value="A" checked>
        A
        </label>
        <label >
        <input type="radio" name="dkk" class="input-radio" value="B">
        B
        </label>
        <label >
        <input type="radio" name="dkk" class="input-radio" value="C">
        C
        </label>
    </div>

    <div class="form-group">
    <p>DLK:</p>
        <label >
        <input type="radio" name="dlk" class="input-radio" value="0" checked>
        0
        </label>
        <label >
        <input type="radio" name="dlk" class="input-radio" value="1">
        1
        </label>
        <label >
        <input type="radio" name="dlk" class="input-radio" value="2">
        2
        </label>
    </div>

    <div class="form-group">
        <button type="submit" id="submit" class="submit-button">Odeslat
        </button>
    </div>

</form>

