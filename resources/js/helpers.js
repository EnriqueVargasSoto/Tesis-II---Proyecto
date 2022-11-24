import { random } from "lodash";

var colors = [
    {
        name: "Absolute Zero",
        hex: "#0048BA"
    },
    {
        name: "Acid Green",
        hex: "#B0BF1A"
    },
    {
        name: "Aero",
        hex: "#7CB9E8"
    },
    {
        name: "Aero Blue",
        hex: "#C9FFE5"
    },
    {
        name: "African Violet",
        hex: "#B284BE"
    },
    {
        name: "Air Force Blue (RAF)",
        hex: "#5D8AA8"
    },
    {
        name: "Air Force Blue (USAF)",
        hex: "#00308F"
    },
    {
        name: "Air Superiority Blue",
        hex: "#72A0C1"
    },
    {
        name: "Alabama Crimson",
        hex: "#AF002A"
    },
    {
        name: "Alabaster",
        hex: "#F2F0E6"
    },
    {
        name: "Alice Blue",
        hex: "#F0F8FF"
    },
    {
        name: "Alien Armpit",
        hex: "#84DE02"
    },
    {
        name: "Alizarin Crimson",
        hex: "#E32636"
    },
    {
        name: "Alloy Orange",
        hex: "#C46210"
    },
    {
        name: "Almond",
        hex: "#EFDECD"
    },
    {
        name: "Amaranth",
        hex: "#E52B50"
    },
    {
        name: "Amaranth Deep Purple",
        hex: "#9F2B68"
    },
    {
        name: "Amaranth Pink",
        hex: "#F19CBB"
    },
    {
        name: "Amaranth Purple",
        hex: "#AB274F"
    },
    {
        name: "Amaranth Red",
        hex: "#D3212D"
    },
    {
        name: "Amazon Store",
        hex: "#3B7A57"
    },
    {
        name: "Amazonite",
        hex: "#00C4B0"
    },
    {
        name: "Amber",
        hex: "#FFBF00"
    },
    {
        name: "Amber (SAE/ECE)",
        hex: "#FF7E00"
    },
    {
        name: "American Rose",
        hex: "#FF033E"
    },
    {
        name: "Amethyst",
        hex: "#9966CC"
    },
    {
        name: "Android Green",
        hex: "#A4C639"
    },
    {
        name: "Anti-Flash White",
        hex: "#F2F3F4"
    },
    {
        name: "Antique Brass",
        hex: "#CD9575"
    },
    {
        name: "Antique Bronze",
        hex: "#665D1E"
    },
    {
        name: "Antique Fuchsia",
        hex: "#915C83"
    },
    {
        name: "Antique Ruby",
        hex: "#841B2D"
    },
    {
        name: "Antique White",
        hex: "#FAEBD7"
    },
    {
        name: "Ao (English)",
        hex: "#008000"
    },
    {
        name: "Apple Green",
        hex: "#8DB600"
    },
    {
        name: "Apricot",
        hex: "#FBCEB1"
    },
    {
        name: "Aqua",
        hex: "#00FFFF"
    },
    {
        name: "Aquamarine",
        hex: "#7FFFD4"
    },
    {
        name: "Arctic Lime",
        hex: "#D0FF14"
    },
    {
        name: "Army Green",
        hex: "#4B5320"
    },
    {
        name: "Arsenic",
        hex: "#3B444B"
    },
    {
        name: "Artichoke",
        hex: "#8F9779"
    },
    {
        name: "Arylide Yellow",
        hex: "#E9D66B"
    },
    {
        name: "Ash Gray",
        hex: "#B2BEB5"
    },
    {
        name: "Asparagus",
        hex: "#87A96B"
    },
    {
        name: "Atomic Tangerine",
        hex: "#FF9966"
    },
    {
        name: "Auburn",
        hex: "#A52A2A"
    },
    {
        name: "Aureolin",
        hex: "#FDEE00"
    },
    {
        name: "AuroMetalSaurus",
        hex: "#6E7F80"
    },
    {
        name: "Avocado",
        hex: "#568203"
    },
    {
        name: "Awesome",
        hex: "#FF2052"
    },
    {
        name: "Aztec Gold",
        hex: "#C39953"
    },
    {
        name: "Azure",
        hex: "#007FFF"
    },
    {
        name: "Azure (Web Color)",
        hex: "#F0FFFF"
    },
    {
        name: "Azure Mist",
        hex: "#F0FFFF"
    },
    {
        name: "Azureish White",
        hex: "#DBE9F4"
    },
    {
        name: "Baby Blue",
        hex: "#89CFF0"
    },
    {
        name: "Baby Blue Eyes",
        hex: "#A1CAF1"
    },
    {
        name: "Baby Pink",
        hex: "#F4C2C2"
    },
    {
        name: "Baby Powder",
        hex: "#FEFEFA"
    },
    {
        name: "Baker-Miller Pink",
        hex: "#FF91AF"
    },
    {
        name: "Ball Blue",
        hex: "#21ABCD"
    },
    {
        name: "Banana Mania",
        hex: "#FAE7B5"
    },
    {
        name: "Banana Yellow",
        hex: "#FFE135"
    },
    {
        name: "Bangladesh Green",
        hex: "#006A4E"
    },
    {
        name: "Barbie Pink",
        hex: "#E0218A"
    },
    {
        name: "Barn Red",
        hex: "#7C0A02"
    },
    {
        name: "Battery Charged Blue",
        hex: "#1DACD6"
    },
    {
        name: "Battleship Grey",
        hex: "#848482"
    },
    {
        name: "Bazaar",
        hex: "#98777B"
    },
    {
        name: "Beau Blue",
        hex: "#BCD4E6"
    },
    {
        name: "Beaver",
        hex: "#9F8170"
    },
    {
        name: "Begonia",
        hex: "#FA6E79"
    },
    {
        name: "Beige",
        hex: "#F5F5DC"
    },
    {
        name: "B'dazzled Blue",
        hex: "#2E5894"
    },
    {
        name: "Big Dip O'ruby",
        hex: "#9C2542"
    },
    {
        name: "Big Foot Feet",
        hex: "#E88E5A"
    },
    {
        name: "Bisque",
        hex: "#FFE4C4"
    },
    {
        name: "Bistre",
        hex: "#3D2B1F"
    },
    {
        name: "Bistre Brown",
        hex: "#967117"
    },
    {
        name: "Bitter Lemon",
        hex: "#CAE00D"
    },
    {
        name: "Bitter Lime",
        hex: "#BFFF00"
    },
    {
        name: "Bittersweet",
        hex: "#FE6F5E"
    },
    {
        name: "Bittersweet Shimmer",
        hex: "#BF4F51"
    },
    {
        name: "Black",
        hex: "#000000"
    },
    {
        name: "Black Bean",
        hex: "#3D0C02"
    },
    {
        name: "Black Coral",
        hex: "#54626F"
    },
    {
        name: "Black Leather Jacket",
        hex: "#253529"
    },
    {
        name: "Black Olive",
        hex: "#3B3C36"
    },
    {
        name: "Black Shadows",
        hex: "#BFAFB2"
    },
    {
        name: "Blanched Almond",
        hex: "#FFEBCD"
    },
    {
        name: "Blast-Off Bronze",
        hex: "#A57164"
    },
    {
        name: "Bleu De France",
        hex: "#318CE7"
    },
    {
        name: "Blizzard Blue",
        hex: "#ACE5EE"
    },
    {
        name: "Blond",
        hex: "#FAF0BE"
    },
    {
        name: "Blue",
        hex: "#0000FF"
    },
    {
        name: "Blue (Crayola)",
        hex: "#1F75FE"
    },
    {
        name: "Blue (Munsell)",
        hex: "#0093AF"
    },
    {
        name: "Blue (NCS)",
        hex: "#0087BD"
    },
    {
        name: "Blue (Pantone)",
        hex: "#0018A8"
    },
    {
        name: "Blue (Pigment)",
        hex: "#333399"
    },
    {
        name: "Blue (RYB)",
        hex: "#0247FE"
    },
    {
        name: "Blue Bell",
        hex: "#A2A2D0"
    },
    {
        name: "Blue Bolt",
        hex: "#00B9FB"
    },
    {
        name: "Blue-Gray",
        hex: "#6699CC"
    },
    {
        name: "Blue-Green",
        hex: "#0D98BA"
    },
    {
        name: "Blue Jeans",
        hex: "#5DADEC"
    },
    {
        name: "Blue Lagoon",
        hex: "#ACE5EE"
    },
    {
        name: "Blue-Magenta Violet",
        hex: "#553592"
    },
    {
        name: "Blue Sapphire",
        hex: "#126180"
    },
    {
        name: "Blue-Violet",
        hex: "#8A2BE2"
    },
    {
        name: "Blue Yonder",
        hex: "#5072A7"
    },
    {
        name: "Blueberry",
        hex: "#4F86F7"
    },
    {
        name: "Bluebonnet",
        hex: "#1C1CF0"
    },
    {
        name: "Blush",
        hex: "#DE5D83"
    },
    {
        name: "Bole",
        hex: "#79443B"
    },
    {
        name: "Bondi Blue",
        hex: "#0095B6"
    },
    {
        name: "Bone",
        hex: "#E3DAC9"
    },
    {
        name: "Booger Buster",
        hex: "#DDE26A"
    },
    {
        name: "Boston University Red",
        hex: "#CC0000"
    },
    {
        name: "Bottle Green",
        hex: "#006A4E"
    },
    {
        name: "Boysenberry",
        hex: "#873260"
    },
    {
        name: "Brandeis Blue",
        hex: "#0070FF"
    },
    {
        name: "Brass",
        hex: "#B5A642"
    },
    {
        name: "Brick Red",
        hex: "#CB4154"
    },
    {
        name: "Bright Cerulean",
        hex: "#1DACD6"
    },
    {
        name: "Bright Green",
        hex: "#66FF00"
    },
    {
        name: "Bright Lavender",
        hex: "#BF94E4"
    },
    {
        name: "Bright Lilac",
        hex: "#D891EF"
    },
    {
        name: "Bright Maroon",
        hex: "#C32148"
    },
    {
        name: "Bright Navy Blue",
        hex: "#1974D2"
    },
    {
        name: "Bright Pink",
        hex: "#FF007F"
    },
    {
        name: "Bright Turquoise",
        hex: "#08E8DE"
    },
    {
        name: "Bright Ube",
        hex: "#D19FE8"
    },
    {
        name: "Bright Yellow (Crayola)",
        hex: "#FFAA1D"
    },
    {
        name: "Brilliant Azure",
        hex: "#3399FF"
    },
    {
        name: "Brilliant Lavender",
        hex: "#F4BBFF"
    },
    {
        name: "Brilliant Rose",
        hex: "#FF55A3"
    },
    {
        name: "Brink Pink",
        hex: "#FB607F"
    },
    {
        name: "British Racing Green",
        hex: "#004225"
    },
    {
        name: "Bronze",
        hex: "#CD7F32"
    },
    {
        name: "Bronze Yellow",
        hex: "#737000"
    },
    {
        name: "Brown (Traditional)",
        hex: "#964B00"
    },
    {
        name: "Brown (Web)",
        hex: "#A52A2A"
    },
    {
        name: "Brown-Nose",
        hex: "#6B4423"
    },
    {
        name: "Brown Sugar",
        hex: "#AF6E4D"
    },
    {
        name: "Brown Yellow",
        hex: "#cc9966"
    },
    {
        name: "Brunswick Green",
        hex: "#1B4D3E"
    },
    {
        name: "Bubble Gum",
        hex: "#FFC1CC"
    },
    {
        name: "Bubbles",
        hex: "#E7FEFF"
    },
    {
        name: "Bud Green",
        hex: "#7BB661"
    },
    {
        name: "Buff",
        hex: "#F0DC82"
    },
    {
        name: "Bulgarian Rose",
        hex: "#480607"
    },
    {
        name: "Burgundy",
        hex: "#800020"
    },
    {
        name: "Burlywood",
        hex: "#DEB887"
    },
    {
        name: "Burnished Brown",
        hex: "#A17A74"
    },
    {
        name: "Burnt Orange",
        hex: "#CC5500"
    },
    {
        name: "Burnt Sienna",
        hex: "#E97451"
    },
    {
        name: "Burnt Umber",
        hex: "#8A3324"
    },
    {
        name: "Button Blue",
        hex: "#24A0ED"
    },
    {
        name: "Byzantine",
        hex: "#BD33A4"
    },
    {
        name: "Byzantium",
        hex: "#702963"
    },
    {
        name: "Cadet",
        hex: "#536872"
    },
    {
        name: "Cadet Blue",
        hex: "#5F9EA0"
    },
    {
        name: "Cadet Grey",
        hex: "#91A3B0"
    },
    {
        name: "Cadmium Green",
        hex: "#006B3C"
    },
    {
        name: "Cadmium Orange",
        hex: "#ED872D"
    },
    {
        name: "Cadmium Red",
        hex: "#E30022"
    },
    {
        name: "Cadmium Yellow",
        hex: "#FFF600"
    },
    {
        name: "Cafe Au Lait",
        hex: "#A67B5B"
    },
    {
        name: "Cafe Noir",
        hex: "#4B3621"
    },
    {
        name: "Cal Poly Pomona Green",
        hex: "#1E4D2B"
    },
    {
        name: "Cambridge Blue",
        hex: "#A3C1AD"
    },
    {
        name: "Camel",
        hex: "#C19A6B"
    },
    {
        name: "Cameo Pink",
        hex: "#EFBBCC"
    },
    {
        name: "Camouflage Green",
        hex: "#78866B"
    },
    {
        name: "Canary",
        hex: "#FFFF99"
    },
    {
        name: "Canary Yellow",
        hex: "#FFEF00"
    },
    {
        name: "Candy Apple Red",
        hex: "#FF0800"
    },
    {
        name: "Candy Pink",
        hex: "#E4717A"
    },
    {
        name: "Capri",
        hex: "#00BFFF"
    },
    {
        name: "Caput Mortuum",
        hex: "#592720"
    },
    {
        name: "Cardinal",
        hex: "#C41E3A"
    },
    {
        name: "Caribbean Green",
        hex: "#00CC99"
    },
    {
        name: "Carmine",
        hex: "#960018"
    },
    {
        name: "Carmine (M&P)",
        hex: "#D70040"
    },
    {
        name: "Carmine Pink",
        hex: "#EB4C42"
    },
    {
        name: "Carmine Red",
        hex: "#FF0038"
    },
    {
        name: "Carnation Pink",
        hex: "#FFA6C9"
    },
    {
        name: "Carnelian",
        hex: "#B31B1B"
    },
    {
        name: "Carolina Blue",
        hex: "#56A0D3"
    },
    {
        name: "Carrot Orange",
        hex: "#ED9121"
    },
    {
        name: "Castleton Green",
        hex: "#00563F"
    },
    {
        name: "Catalina Blue",
        hex: "#062A78"
    },
    {
        name: "Catawba",
        hex: "#703642"
    },
    {
        name: "Cedar Chest",
        hex: "#C95A49"
    },
    {
        name: "Ceil",
        hex: "#92A1CF"
    },
    {
        name: "Celadon",
        hex: "#ACE1AF"
    },
    {
        name: "Celadon Blue",
        hex: "#007BA7"
    },
    {
        name: "Celadon Green",
        hex: "#2F847C"
    },
    {
        name: "Celeste",
        hex: "#B2FFFF"
    },
    {
        name: "Celestial Blue",
        hex: "#4997D0"
    },
    {
        name: "Cerise",
        hex: "#DE3163"
    },
    {
        name: "Cerise Pink",
        hex: "#EC3B83"
    },
    {
        name: "Cerulean",
        hex: "#007BA7"
    },
    {
        name: "Cerulean Blue",
        hex: "#2A52BE"
    },
    {
        name: "Cerulean Frost",
        hex: "#6D9BC3"
    },
    {
        name: "CG Blue",
        hex: "#007AA5"
    },
    {
        name: "CG Red",
        hex: "#E03C31"
    },
    {
        name: "Chamoisee",
        hex: "#A0785A"
    },
    {
        name: "Champagne",
        hex: "#F7E7CE"
    },
    {
        name: "Champagne Pink",
        hex: "#F1DDCF"
    },
    {
        name: "Charcoal",
        hex: "#36454F"
    },
    {
        name: "Charleston Green",
        hex: "#232B2B"
    },
    {
        name: "Charm Pink",
        hex: "#E68FAC"
    },
    {
        name: "Chartreuse (Traditional)",
        hex: "#DFFF00"
    },
    {
        name: "Chartreuse (Web)",
        hex: "#7FFF00"
    },
    {
        name: "Cherry",
        hex: "#DE3163"
    },
    {
        name: "Cherry Blossom Pink",
        hex: "#FFB7C5"
    },
    {
        name: "Chestnut",
        hex: "#954535"
    },
    {
        name: "China Pink",
        hex: "#DE6FA1"
    },
    {
        name: "China Rose",
        hex: "#A8516E"
    },
    {
        name: "Chinese Red",
        hex: "#AA381E"
    },
    {
        name: "Chinese Violet",
        hex: "#856088"
    },
    {
        name: "Chlorophyll Green",
        hex: "#4AFF00"
    },
    {
        name: "Chocolate (Traditional)",
        hex: "#7B3F00"
    },
    {
        name: "Chocolate (Web)",
        hex: "#D2691E"
    },
    {
        name: "Chrome Yellow",
        hex: "#FFA700"
    },
    {
        name: "Cinereous",
        hex: "#98817B"
    },
    {
        name: "Cinnabar",
        hex: "#E34234"
    },
    {
        name: "Cinnamon",
        hex: "#D2691E"
    },
    {
        name: "Cinnamon Satin",
        hex: "#CD607E"
    },
    {
        name: "Citrine",
        hex: "#E4D00A"
    },
    {
        name: "Citron",
        hex: "#9FA91F"
    },
    {
        name: "Claret",
        hex: "#7F1734"
    },
    {
        name: "Classic Rose",
        hex: "#FBCCE7"
    },
    {
        name: "Cobalt Blue",
        hex: "#0047AB"
    },
    {
        name: "Cocoa Brown",
        hex: "#D2691E"
    },
    {
        name: "Coconut",
        hex: "#965A3E"
    },
    {
        name: "Coffee",
        hex: "#6F4E37"
    },
    {
        name: "Columbia Blue",
        hex: "#C4D8E2"
    },
    {
        name: "Congo Pink",
        hex: "#F88379"
    },
    {
        name: "Cool Black",
        hex: "#002E63"
    },
    {
        name: "Cool Grey",
        hex: "#8C92AC"
    },
    {
        name: "Copper",
        hex: "#B87333"
    },
    {
        name: "Copper (Crayola)",
        hex: "#DA8A67"
    },
    {
        name: "Copper Penny",
        hex: "#AD6F69"
    },
    {
        name: "Copper Red",
        hex: "#CB6D51"
    },
    {
        name: "Copper Rose",
        hex: "#996666"
    },
    {
        name: "Coquelicot",
        hex: "#FF3800"
    },
    {
        name: "Coral",
        hex: "#FF7F50"
    },
    {
        name: "Coral Pink",
        hex: "#F88379"
    },
    {
        name: "Coral Red",
        hex: "#FF4040"
    },
    {
        name: "Coral Reef",
        hex: "#FD7C6E"
    },
    {
        name: "Cordovan",
        hex: "#893F45"
    },
    {
        name: "Corn",
        hex: "#FBEC5D"
    },
    {
        name: "Cornell Red",
        hex: "#B31B1B"
    },
    {
        name: "Cornflower Blue",
        hex: "#6495ED"
    },
    {
        name: "Cornsilk",
        hex: "#FFF8DC"
    },
    {
        name: "Cosmic Cobalt",
        hex: "#2E2D88"
    },
    {
        name: "Cosmic Latte",
        hex: "#FFF8E7"
    },
    {
        name: "Coyote Brown",
        hex: "#81613C"
    },
    {
        name: "Cotton Candy",
        hex: "#FFBCD9"
    },
    {
        name: "Cream",
        hex: "#FFFDD0"
    },
    {
        name: "Crimson",
        hex: "#DC143C"
    },
    {
        name: "Crimson Glory",
        hex: "#BE0032"
    },
    {
        name: "Crimson Red",
        hex: "#990000"
    },
    {
        name: "Cultured",
        hex: "#F5F5F5"
    },
    {
        name: "Cyan",
        hex: "#00FFFF"
    },
    {
        name: "Cyan Azure",
        hex: "#4E82B4"
    },
    {
        name: "Cyan-Blue Azure",
        hex: "#4682BF"
    },
    {
        name: "Cyan Cobalt Blue",
        hex: "#28589C"
    },
    {
        name: "Cyan Cornflower Blue",
        hex: "#188BC2"
    },
    {
        name: "Cyan (Process)",
        hex: "#00B7EB"
    },
    {
        name: "Cyber Grape",
        hex: "#58427C"
    },
    {
        name: "Cyber Yellow",
        hex: "#FFD300"
    },
    {
        name: "Cyclamen",
        hex: "#F56FA1"
    },
    {
        name: "Daffodil",
        hex: "#FFFF31"
    },
    {
        name: "Dandelion",
        hex: "#F0E130"
    },
    {
        name: "Dark Blue",
        hex: "#00008B"
    },
    {
        name: "Dark Blue-Gray",
        hex: "#666699"
    },
    {
        name: "Dark Brown",
        hex: "#654321"
    },
    {
        name: "Dark Brown-Tangelo",
        hex: "#88654E"
    },
    {
        name: "Dark Byzantium",
        hex: "#5D3954"
    },
    {
        name: "Dark Candy Apple Red",
        hex: "#A40000"
    },
    {
        name: "Dark Cerulean",
        hex: "#08457E"
    },
    {
        name: "Dark Chestnut",
        hex: "#986960"
    },
    {
        name: "Dark Coral",
        hex: "#CD5B45"
    },
    {
        name: "Dark Cyan",
        hex: "#008B8B"
    },
    {
        name: "Dark Electric Blue",
        hex: "#536878"
    },
    {
        name: "Dark Goldenrod",
        hex: "#B8860B"
    },
    {
        name: "Dark Gray (X11)",
        hex: "#A9A9A9"
    },
    {
        name: "Dark Green",
        hex: "#013220"
    },
    {
        name: "Dark Green (X11)",
        hex: "#006400"
    },
    {
        name: "Dark Gunmetal",
        hex: "#1F262A"
    },
    {
        name: "Dark Imperial Blue",
        hex: "#00416A"
    },
    {
        name: "Dark Imperial Blue",
        hex: "#00147E"
    },
    {
        name: "Dark Jungle Green",
        hex: "#1A2421"
    },
    {
        name: "Dark Khaki",
        hex: "#BDB76B"
    },
    {
        name: "Dark Lava",
        hex: "#483C32"
    },
    {
        name: "Dark Lavender",
        hex: "#734F96"
    },
    {
        name: "Dark Liver",
        hex: "#534B4F"
    },
    {
        name: "Dark Liver (Horses)",
        hex: "#543D37"
    },
    {
        name: "Dark Magenta",
        hex: "#8B008B"
    },
    {
        name: "Dark Medium Gray",
        hex: "#A9A9A9"
    },
    {
        name: "Dark Midnight Blue",
        hex: "#003366"
    },
    {
        name: "Dark Moss Green",
        hex: "#4A5D23"
    },
    {
        name: "Dark Olive Green",
        hex: "#556B2F"
    },
    {
        name: "Dark Orange",
        hex: "#FF8C00"
    },
    {
        name: "Dark Orchid",
        hex: "#9932CC"
    },
    {
        name: "Dark Pastel Blue",
        hex: "#779ECB"
    },
    {
        name: "Dark Pastel Green",
        hex: "#03C03C"
    },
    {
        name: "Dark Pastel Purple",
        hex: "#966FD6"
    },
    {
        name: "Dark Pastel Red",
        hex: "#C23B22"
    },
    {
        name: "Dark Pink",
        hex: "#E75480"
    },
    {
        name: "Dark Powder Blue",
        hex: "#003399"
    },
    {
        name: "Dark Puce",
        hex: "#4F3A3C"
    },
    {
        name: "Dark Purple",
        hex: "#301934"
    },
    {
        name: "Dark Raspberry",
        hex: "#872657"
    },
    {
        name: "Dark Red",
        hex: "#8B0000"
    },
    {
        name: "Dark Salmon",
        hex: "#E9967A"
    },
    {
        name: "Dark Scarlet",
        hex: "#560319"
    },
    {
        name: "Dark Sea Green",
        hex: "#8FBC8F"
    },
    {
        name: "Dark Sienna",
        hex: "#3C1414"
    },
    {
        name: "Dark Sky Blue",
        hex: "#8CBED6"
    },
    {
        name: "Dark Slate Blue",
        hex: "#483D8B"
    },
    {
        name: "Dark Slate Gray",
        hex: "#2F4F4F"
    },
    {
        name: "Dark Spring Green",
        hex: "#177245"
    },
    {
        name: "Dark Tan",
        hex: "#918151"
    },
    {
        name: "Dark Tangerine",
        hex: "#FFA812"
    },
    {
        name: "Dark Taupe",
        hex: "#483C32"
    },
    {
        name: "Dark Terra Cotta",
        hex: "#CC4E5C"
    },
    {
        name: "Dark Turquoise",
        hex: "#00CED1"
    },
    {
        name: "Dark Vanilla",
        hex: "#D1BEA8"
    },
    {
        name: "Dark Violet",
        hex: "#9400D3"
    },
    {
        name: "Dark Yellow",
        hex: "#9B870C"
    },
    {
        name: "Dartmouth Green",
        hex: "#00703C"
    },
    {
        name: "Davy's Grey",
        hex: "#555555"
    },
    {
        name: "Debian Red",
        hex: "#D70A53"
    },
    {
        name: "Deep Aquamarine",
        hex: "#40826D"
    },
    {
        name: "Deep Carmine",
        hex: "#A9203E"
    },
    {
        name: "Deep Carmine Pink",
        hex: "#EF3038"
    },
    {
        name: "Deep Carrot Orange",
        hex: "#E9692C"
    },
    {
        name: "Deep Cerise",
        hex: "#DA3287"
    },
    {
        name: "Deep Champagne",
        hex: "#FAD6A5"
    },
    {
        name: "Deep Chestnut",
        hex: "#B94E48"
    },
    {
        name: "Deep Coffee",
        hex: "#704241"
    },
    {
        name: "Deep Fuchsia",
        hex: "#C154C1"
    },
    {
        name: "Deep Green",
        hex: "#056608"
    },
    {
        name: "Deep Green-Cyan Turquoise",
        hex: "#0E7C61"
    },
    {
        name: "Deep Jungle Green",
        hex: "#004B49"
    },
    {
        name: "Deep Koamaru",
        hex: "#333366"
    },
    {
        name: "Deep Lemon",
        hex: "#F5C71A"
    },
    {
        name: "Deep Lilac",
        hex: "#9955BB"
    },
    {
        name: "Deep Magenta",
        hex: "#CC00CC"
    },
    {
        name: "Deep Maroon",
        hex: "#820000"
    },
    {
        name: "Deep Mauve",
        hex: "#D473D4"
    },
    {
        name: "Deep Moss Green",
        hex: "#355E3B"
    },
    {
        name: "Deep Peach",
        hex: "#FFCBA4"
    },
    {
        name: "Deep Pink",
        hex: "#FF1493"
    },
    {
        name: "Deep Puce",
        hex: "#A95C68"
    },
    {
        name: "Deep Red",
        hex: "#850101"
    },
    {
        name: "Deep Ruby",
        hex: "#843F5B"
    },
    {
        name: "Deep Saffron",
        hex: "#FF9933"
    },
    {
        name: "Deep Sky Blue",
        hex: "#00BFFF"
    },
    {
        name: "Deep Space Sparkle",
        hex: "#4A646C"
    },
    {
        name: "Deep Spring Bud",
        hex: "#556B2F"
    },
    {
        name: "Deep Taupe",
        hex: "#7E5E60"
    },
    {
        name: "Deep Tuscan Red",
        hex: "#66424D"
    },
    {
        name: "Deep Violet",
        hex: "#330066"
    },
    {
        name: "Deer",
        hex: "#BA8759"
    },
    {
        name: "Denim",
        hex: "#1560BD"
    },
    {
        name: "Denim Blue",
        hex: "#2243B6"
    },
    {
        name: "Desaturated Cyan",
        hex: "#669999"
    },
    {
        name: "Desert",
        hex: "#C19A6B"
    },
    {
        name: "Desert Sand",
        hex: "#EDC9AF"
    },
    {
        name: "Desire",
        hex: "#EA3C53"
    },
    {
        name: "Diamond",
        hex: "#B9F2FF"
    },
    {
        name: "Dim Gray",
        hex: "#696969"
    },
    {
        name: "Dingy Dungeon",
        hex: "#C53151"
    },
    {
        name: "Dirt",
        hex: "#9B7653"
    },
    {
        name: "Dodger Blue",
        hex: "#1E90FF"
    },
    {
        name: "Dodie Yellow",
        hex: "#FEF65B"
    },
    {
        name: "Dogwood Rose",
        hex: "#D71868"
    },
    {
        name: "Dollar Bill",
        hex: "#85BB65"
    },
    {
        name: "Dolphin Gray",
        hex: "#828E84"
    },
    {
        name: "Donkey Brown",
        hex: "#664C28"
    },
    {
        name: "Drab",
        hex: "#967117"
    },
    {
        name: "Duke Blue",
        hex: "#00009C"
    },
    {
        name: "Dust Storm",
        hex: "#E5CCC9"
    },
    {
        name: "Dutch White",
        hex: "#EFDFBB"
    },
    {
        name: "Earth Yellow",
        hex: "#E1A95F"
    },
    {
        name: "Ebony",
        hex: "#555D50"
    },
    {
        name: "Ecru",
        hex: "#C2B280"
    },
    {
        name: "Eerie Black",
        hex: "#1B1B1B"
    },
    {
        name: "Eggplant",
        hex: "#614051"
    },
    {
        name: "Eggshell",
        hex: "#F0EAD6"
    },
    {
        name: "Egyptian Blue",
        hex: "#1034A6"
    },
    {
        name: "Electric Blue",
        hex: "#7DF9FF"
    },
    {
        name: "Electric Crimson",
        hex: "#FF003F"
    },
    {
        name: "Electric Cyan",
        hex: "#00FFFF"
    },
    {
        name: "Electric Green",
        hex: "#00FF00"
    },
    {
        name: "Electric Indigo",
        hex: "#6F00FF"
    },
    {
        name: "Electric Lavender",
        hex: "#F4BBFF"
    },
    {
        name: "Electric Lime",
        hex: "#CCFF00"
    },
    {
        name: "Electric Purple",
        hex: "#BF00FF"
    },
    {
        name: "Electric Ultramarine",
        hex: "#3F00FF"
    },
    {
        name: "Electric Violet",
        hex: "#8F00FF"
    },
    {
        name: "Electric Yellow",
        hex: "#FFFF33"
    },
    {
        name: "Emerald",
        hex: "#50C878"
    },
    {
        name: "Eminence",
        hex: "#6C3082"
    },
    {
        name: "English Green",
        hex: "#1B4D3E"
    },
    {
        name: "English Lavender",
        hex: "#B48395"
    },
    {
        name: "English Red",
        hex: "#AB4B52"
    },
    {
        name: "English Vermillion",
        hex: "#CC474B"
    },
    {
        name: "English Violet",
        hex: "#563C5C"
    },
    {
        name: "Eton Blue",
        hex: "#96C8A2"
    },
    {
        name: "Eucalyptus",
        hex: "#44D7A8"
    },
    {
        name: "Fallow",
        hex: "#C19A6B"
    },
    {
        name: "Falu Red",
        hex: "#801818"
    },
    {
        name: "Fandango",
        hex: "#B53389"
    },
    {
        name: "Fandango Pink",
        hex: "#DE5285"
    },
    {
        name: "Fashion Fuchsia",
        hex: "#F400A1"
    },
    {
        name: "Fawn",
        hex: "#E5AA70"
    },
    {
        name: "Feldgrau",
        hex: "#4D5D53"
    },
    {
        name: "Feldspar",
        hex: "#FDD5B1"
    },
    {
        name: "Fern Green",
        hex: "#4F7942"
    },
    {
        name: "Ferrari Red",
        hex: "#FF2800"
    },
    {
        name: "Field Drab",
        hex: "#6C541E"
    },
    {
        name: "Fiery Rose",
        hex: "#FF5470"
    },
    {
        name: "Firebrick",
        hex: "#B22222"
    },
    {
        name: "Fire Engine Red",
        hex: "#CE2029"
    },
    {
        name: "Flame",
        hex: "#E25822"
    },
    {
        name: "Flamingo Pink",
        hex: "#FC8EAC"
    },
    {
        name: "Flattery",
        hex: "#6B4423"
    },
    {
        name: "Flavescent",
        hex: "#F7E98E"
    },
    {
        name: "Flax",
        hex: "#EEDC82"
    },
    {
        name: "Flirt",
        hex: "#A2006D"
    },
    {
        name: "Floral White",
        hex: "#FFFAF0"
    },
    {
        name: "Fluorescent Orange",
        hex: "#FFBF00"
    },
    {
        name: "Fluorescent Pink",
        hex: "#FF1493"
    },
    {
        name: "Fluorescent Yellow",
        hex: "#CCFF00"
    },
    {
        name: "Folly",
        hex: "#FF004F"
    },
    {
        name: "Forest Green (Traditional)",
        hex: "#014421"
    },
    {
        name: "Forest Green (Web)",
        hex: "#228B22"
    },
    {
        name: "French Beige",
        hex: "#A67B5B"
    },
    {
        name: "French Bistre",
        hex: "#856D4D"
    },
    {
        name: "French Blue",
        hex: "#0072BB"
    },
    {
        name: "French Fuchsia",
        hex: "#FD3F92"
    },
    {
        name: "French Lilac",
        hex: "#86608E"
    },
    {
        name: "French Lime",
        hex: "#9EFD38"
    },
    {
        name: "French Mauve",
        hex: "#D473D4"
    },
    {
        name: "French Pink",
        hex: "#FD6C9E"
    },
    {
        name: "French Plum",
        hex: "#811453"
    },
    {
        name: "French Puce",
        hex: "#4E1609"
    },
    {
        name: "French Raspberry",
        hex: "#C72C48"
    },
    {
        name: "French Rose",
        hex: "#F64A8A"
    },
    {
        name: "French Sky Blue",
        hex: "#77B5FE"
    },
    {
        name: "French Violet",
        hex: "#8806CE"
    },
    {
        name: "French Wine",
        hex: "#AC1E44"
    },
    {
        name: "Fresh Air",
        hex: "#A6E7FF"
    },
    {
        name: "Frogert",
        hex: "#E936A7"
    },
    {
        name: "Fuchsia",
        hex: "#FF00FF"
    },
    {
        name: "Fuchsia (Crayola)",
        hex: "#C154C1"
    },
    {
        name: "Fuchsia Pink",
        hex: "#FF77FF"
    },
    {
        name: "Fuchsia Purple",
        hex: "#CC397B"
    },
    {
        name: "Fuchsia Rose",
        hex: "#C74375"
    },
    {
        name: "Fulvous",
        hex: "#E48400"
    },
    {
        name: "Fuzzy Wuzzy",
        hex: "#CC6666"
    },
    {
        name: "Gainsboro",
        hex: "#DCDCDC"
    },
    {
        name: "Gamboge",
        hex: "#E49B0F"
    },
    {
        name: "Gamboge Orange (Brown)",
        hex: "#996600"
    },
    {
        name: "Gargoyle Gas",
        hex: "#FFDF46"
    },
    {
        name: "Generic Viridian",
        hex: "#007F66"
    },
    {
        name: "Ghost White",
        hex: "#F8F8FF"
    },
    {
        name: "Giant's Club",
        hex: "#B05C52"
    },
    {
        name: "Giants Orange",
        hex: "#FE5A1D"
    },
    {
        name: "Ginger",
        hex: "#B06500"
    },
    {
        name: "Glaucous",
        hex: "#6082B6"
    },
    {
        name: "Glitter",
        hex: "#E6E8FA"
    },
    {
        name: "Glossy Grape",
        hex: "#AB92B3"
    },
    {
        name: "GO Green",
        hex: "#00AB66"
    },
    {
        name: "Gold (Metallic)",
        hex: "#D4AF37"
    },
    {
        name: "Gold (Web) (Golden)",
        hex: "#FFD700"
    },
    {
        name: "Gold Fusion",
        hex: "#85754E"
    },
    {
        name: "Golden Brown",
        hex: "#996515"
    },
    {
        name: "Golden Poppy",
        hex: "#FCC200"
    },
    {
        name: "Golden Yellow",
        hex: "#FFDF00"
    },
    {
        name: "Goldenrod",
        hex: "#DAA520"
    },
    {
        name: "Granite Gray",
        hex: "#676767"
    },
    {
        name: "Granny Smith Apple",
        hex: "#A8E4A0"
    },
    {
        name: "Grape",
        hex: "#6F2DA8"
    },
    {
        name: "Gray",
        hex: "#808080"
    },
    {
        name: "Gray (HTML/CSS Gray)",
        hex: "#808080"
    },
    {
        name: "Gray (X11 Gray)",
        hex: "#BEBEBE"
    },
    {
        name: "Gray-Asparagus",
        hex: "#465945"
    },
    {
        name: "Gray-Blue",
        hex: "#8C92AC"
    },
    {
        name: "Green (Color Wheel) (X11 Green)",
        hex: "#00FF00"
    },
    {
        name: "Green (Crayola)",
        hex: "#1CAC78"
    },
    {
        name: "Green (HTML/CSS Color)",
        hex: "#008000"
    },
    {
        name: "Green (Munsell)",
        hex: "#00A877"
    },
    {
        name: "Green (NCS)",
        hex: "#009F6B"
    },
    {
        name: "Green (Pantone)",
        hex: "#00AD43"
    },
    {
        name: "Green (Pigment)",
        hex: "#00A550"
    },
    {
        name: "Green (RYB)",
        hex: "#66B032"
    },
    {
        name: "Green-Blue",
        hex: "#1164B4"
    },
    {
        name: "Green-Cyan",
        hex: "#009966"
    },
    {
        name: "Green Lizard",
        hex: "#A7F432"
    },
    {
        name: "Green Sheen",
        hex: "#6EAEA1"
    },
    {
        name: "Green-Yellow",
        hex: "#ADFF2F"
    },
    {
        name: "Grizzly",
        hex: "#885818"
    },
    {
        name: "Grullo",
        hex: "#A99A86"
    },
    {
        name: "Guppie Green",
        hex: "#00FF7F"
    },
    {
        name: "Gunmetal",
        hex: "#2a3439"
    },
    {
        name: "Halaya Ube",
        hex: "#663854"
    },
    {
        name: "Han Blue",
        hex: "#446CCF"
    },
    {
        name: "Han Purple",
        hex: "#5218FA"
    },
    {
        name: "Hansa Yellow",
        hex: "#E9D66B"
    },
    {
        name: "Harlequin",
        hex: "#3FFF00"
    },
    {
        name: "Harlequin Green",
        hex: "#46CB18"
    },
    {
        name: "Harvard Crimson",
        hex: "#C90016"
    },
    {
        name: "Harvest Gold",
        hex: "#DA9100"
    },
    {
        name: "Heart Gold",
        hex: "#808000"
    },
    {
        name: "Heat Wave",
        hex: "#FF7A00"
    },
    {
        name: "Heidelberg Red",
        hex: "#960018"
    },
    {
        name: "Heliotrope",
        hex: "#DF73FF"
    },
    {
        name: "Heliotrope Gray",
        hex: "#AA98A9"
    },
    {
        name: "Heliotrope Magenta",
        hex: "#AA00BB"
    },
    {
        name: "Hollywood Cerise",
        hex: "#F400A1"
    },
    {
        name: "Honeydew",
        hex: "#F0FFF0"
    },
    {
        name: "Honolulu Blue",
        hex: "#006DB0"
    },
    {
        name: "Hooker's Green",
        hex: "#49796B"
    },
    {
        name: "Hot Magenta",
        hex: "#FF1DCE"
    },
    {
        name: "Hot Pink",
        hex: "#FF69B4"
    },
    {
        name: "Hunter Green",
        hex: "#355E3B"
    },
    {
        name: "Iceberg",
        hex: "#71A6D2"
    },
    {
        name: "Icterine",
        hex: "#FCF75E"
    },
    {
        name: "Iguana Green",
        hex: "#71BC78"
    },
    {
        name: "Illuminating Emerald",
        hex: "#319177"
    },
    {
        name: "Imperial",
        hex: "#602F6B"
    },
    {
        name: "Imperial Blue",
        hex: "#002395"
    },
    {
        name: "Imperial Purple",
        hex: "#66023C"
    },
    {
        name: "Imperial Red",
        hex: "#ED2939"
    },
    {
        name: "Inchworm",
        hex: "#B2EC5D"
    },
    {
        name: "Independence",
        hex: "#4C516D"
    },
    {
        name: "India Green",
        hex: "#138808"
    },
    {
        name: "Indian Red",
        hex: "#CD5C5C"
    },
    {
        name: "Indian Yellow",
        hex: "#E3A857"
    },
    {
        name: "Indigo",
        hex: "#4B0082"
    },
    {
        name: "Indigo Dye",
        hex: "#091F92"
    },
    {
        name: "Indigo (Web)",
        hex: "#4B0082"
    },
    {
        name: "Infra Red",
        hex: "#FF496C"
    },
    {
        name: "Interdimensional Blue",
        hex: "#360CCC"
    },
    {
        name: "International Klein Blue",
        hex: "#002FA7"
    },
    {
        name: "International Orange (Aerospace)",
        hex: "#FF4F00"
    },
    {
        name: "International Orange (Engineering)",
        hex: "#BA160C"
    },
    {
        name: "International Orange (Golden Gate Bridge)",
        hex: "#C0362C"
    },
    {
        name: "Iris",
        hex: "#5A4FCF"
    },
    {
        name: "Irresistible",
        hex: "#B3446C"
    },
    {
        name: "Isabelline",
        hex: "#F4F0EC"
    },
    {
        name: "Islamic Green",
        hex: "#009000"
    },
    {
        name: "Italian Sky Blue",
        hex: "#B2FFFF"
    },
    {
        name: "Ivory",
        hex: "#FFFFF0"
    },
    {
        name: "Jade",
        hex: "#00A86B"
    },
    {
        name: "Japanese Carmine",
        hex: "#9D2933"
    },
    {
        name: "Japanese Indigo",
        hex: "#264348"
    },
    {
        name: "Japanese Violet",
        hex: "#5B3256"
    },
    {
        name: "Jasmine",
        hex: "#F8DE7E"
    },
    {
        name: "Jasper",
        hex: "#D73B3E"
    },
    {
        name: "Jazzberry Jam",
        hex: "#A50B5E"
    },
    {
        name: "Jelly Bean",
        hex: "#DA614E"
    },
    {
        name: "Jet",
        hex: "#343434"
    },
    {
        name: "Jonquil",
        hex: "#F4CA16"
    },
    {
        name: "Jordy Blue",
        hex: "#8AB9F1"
    },
    {
        name: "June Bud",
        hex: "#BDDA57"
    },
    {
        name: "Jungle Green",
        hex: "#29AB87"
    },
    {
        name: "Kelly Green",
        hex: "#4CBB17"
    },
    {
        name: "Kenyan Copper",
        hex: "#7C1C05"
    },
    {
        name: "Keppel",
        hex: "#3AB09E"
    },
    {
        name: "Key Lime",
        hex: "#E8F48C"
    },
    {
        name: "Khaki (HTML/CSS) (Khaki)",
        hex: "#C3B091"
    },
    {
        name: "Khaki (X11) (Light Khaki)",
        hex: "#F0E68C"
    },
    {
        name: "Kiwi",
        hex: "#8EE53F"
    },
    {
        name: "Kobe",
        hex: "#882D17"
    },
    {
        name: "Kobi",
        hex: "#E79FC4"
    },
    {
        name: "Kobicha",
        hex: "#6B4423"
    },
    {
        name: "Kombu Green",
        hex: "#354230"
    },
    {
        name: "KSU Purple",
        hex: "#512888"
    },
    {
        name: "KU Crimson",
        hex: "#E8000D"
    },
    {
        name: "La Salle Green",
        hex: "#087830"
    },
    {
        name: "Languid Lavender",
        hex: "#D6CADD"
    },
    {
        name: "Lapis Lazuli",
        hex: "#26619C"
    },
    {
        name: "Laser Lemon",
        hex: "#FFFF66"
    },
    {
        name: "Laurel Green",
        hex: "#A9BA9D"
    },
    {
        name: "Lava",
        hex: "#CF1020"
    },
    {
        name: "Lavender (Floral)",
        hex: "#B57EDC"
    },
    {
        name: "Lavender (Web)",
        hex: "#E6E6FA"
    },
    {
        name: "Lavender Blue",
        hex: "#CCCCFF"
    },
    {
        name: "Lavender Blush",
        hex: "#FFF0F5"
    },
    {
        name: "Lavender Gray",
        hex: "#C4C3D0"
    },
    {
        name: "Lavender Indigo",
        hex: "#9457EB"
    },
    {
        name: "Lavender Magenta",
        hex: "#EE82EE"
    },
    {
        name: "Lavender Mist",
        hex: "#E6E6FA"
    },
    {
        name: "Lavender Pink",
        hex: "#FBAED2"
    },
    {
        name: "Lavender Purple",
        hex: "#967BB6"
    },
    {
        name: "Lavender Rose",
        hex: "#FBA0E3"
    },
    {
        name: "Lawn Green",
        hex: "#7CFC00"
    },
    {
        name: "Lemon",
        hex: "#FFF700"
    },
    {
        name: "Lemon Chiffon",
        hex: "#FFFACD"
    },
    {
        name: "Lemon Curry",
        hex: "#CCA01D"
    },
    {
        name: "Lemon Glacier",
        hex: "#FDFF00"
    },
    {
        name: "Lemon Lime",
        hex: "#E3FF00"
    },
    {
        name: "Lemon Meringue",
        hex: "#F6EABE"
    },
    {
        name: "Lemon Yellow",
        hex: "#FFF44F"
    },
    {
        name: "Licorice",
        hex: "#1A1110"
    },
    {
        name: "Liberty",
        hex: "#545AA7"
    },
    {
        name: "Light Apricot",
        hex: "#FDD5B1"
    },
    {
        name: "Light Blue",
        hex: "#ADD8E6"
    },
    {
        name: "Light Brown",
        hex: "#B5651D"
    },
    {
        name: "Light Carmine Pink",
        hex: "#E66771"
    },
    {
        name: "Light Cobalt Blue",
        hex: "#88ACE0"
    },
    {
        name: "Light Coral",
        hex: "#F08080"
    },
    {
        name: "Light Cornflower Blue",
        hex: "#93CCEA"
    },
    {
        name: "Light Crimson",
        hex: "#F56991"
    },
    {
        name: "Light Cyan",
        hex: "#E0FFFF"
    },
    {
        name: "Light Deep Pink",
        hex: "#FF5CCD"
    },
    {
        name: "Light French Beige",
        hex: "#C8AD7F"
    },
    {
        name: "Light Fuchsia Pink",
        hex: "#F984EF"
    },
    {
        name: "Light Goldenrod Yellow",
        hex: "#FAFAD2"
    },
    {
        name: "Light Gray",
        hex: "#D3D3D3"
    },
    {
        name: "Light Grayish Magenta",
        hex: "#CC99CC"
    },
    {
        name: "Light Green",
        hex: "#90EE90"
    },
    {
        name: "Light Hot Pink",
        hex: "#FFB3DE"
    },
    {
        name: "Light Khaki",
        hex: "#F0E68C"
    },
    {
        name: "Light Medium Orchid",
        hex: "#D39BCB"
    },
    {
        name: "Light Moss Green",
        hex: "#ADDFAD"
    },
    {
        name: "Light Orange",
        hex: "#FED8B1"
    },
    {
        name: "Light Orchid",
        hex: "#E6A8D7"
    },
    {
        name: "Light Pastel Purple",
        hex: "#B19CD9"
    },
    {
        name: "Light Pink",
        hex: "#FFB6C1"
    },
    {
        name: "Light Red Ochre",
        hex: "#E97451"
    },
    {
        name: "Light Salmon",
        hex: "#FFA07A"
    },
    {
        name: "Light Salmon Pink",
        hex: "#FF9999"
    },
    {
        name: "Light Sea Green",
        hex: "#20B2AA"
    },
    {
        name: "Light Sky Blue",
        hex: "#87CEFA"
    },
    {
        name: "Light Slate Gray",
        hex: "#778899"
    },
    {
        name: "Light Steel Blue",
        hex: "#B0C4DE"
    }
];
export default {
    getColor: function(position) {
        return colors[position];
    },
    getArrayColors:function(length){
        var arreglo=[];
        var index=0;
        while( index < length) {
            var numero=random(0,colors.length-1);
            if(arreglo.indexOf(colors[numero])==-1)
            {
                arreglo.push(colors[numero].hex);
                index++;
            }
        }
        return arreglo;
    },

};
