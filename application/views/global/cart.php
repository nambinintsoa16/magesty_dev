<div class="row banniere_livraison">
  
  <style>

  
.controls {
margin-top: 30px;
border: 1px solid transparent;
border-radius: 2px 0 0 2px;
box-sizing: border-box;
-moz-box-sizing: border-box;
height: 32px;
outline: none;
box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#origin-input,
#destination-input {
background-color: #fff;
font-family: Roboto;
font-size: 15px;
font-weight: 300;
margin-left: 12px;
padding: 0 11px 0 13px;
text-overflow: ellipsis;
width: 200px;
}

#origin-input:focus,
#destination-input:focus {
border-color: #4d90fe;
}

#mode-selector {
color: #fff;
background-color: #4d90fe;
margin-left: 12px;
padding: 5px 11px 0px 11px;
}

#mode-selector label {
font-family: Roboto;
font-size: 13px;
font-weight: 300;
}


  </style>

  <input id="origin-input" class="controls" type="text"
      placeholder="Enter an origin location">

  <input id="destination-input" class="controls" type="text"
      placeholder="Enter a destination location">

  <div id="mode-selector" class="controls" style="display: none">
    <input type="radio" name="type" id="changemode-walking" checked="checked" >
    <label for="changemode-walking">Walking</label>

    <input type="radio" name="type" id="changemode-transit">
    <label for="changemode-transit">Transit</label>

    <input type="radio" name="type" id="changemode-driving">
    <label for="changemode-driving">Driving</label>
  </div>
</div> 



<div id="map" style="border: solid gray 1px;height:750px;"></div>



   