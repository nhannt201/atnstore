<?php

			$conn = pg_connect("host=ec2-54-146-73-98.compute-1.amazonaws.com port=5432 dbname=d9em16ehhf5pme user=wofdatlexxslwy password=1666c34bee3841c53bfd8512e9a871179c3d7fd9beb920690162b79060bc7055");
			//new PDO("pgsql:host=ec2-52-1-115-6.compute-1.amazonaws.com;port=5432;dbname=dfc9kg4tdm8436;user=wimolppypfmrfd;password=45bdbcb28245bfb01ce99e2a525bdab01b81e7aa922696c14984d800fcf9071b");
			pg_set_client_encoding($conn, "UTF8");
//DROP TABLE IF EXISTS product;
			$q2 = "


CREATE TABLE product (
    productid SERIAL PRIMARY KEY,
    category smallint,
    name TEXT NOT NULL,
    price integer,
    img TEXT NOT NULL,
    descc TEXT NOT NULL,
    config TEXT NOT NULL,
    sale smallint
);

	
INSERT INTO product ( category, name, price, img, descc, config, sale) VALUES
( 1, 'Calming Clouds™ Mobile &amp; Soother', 500000, 'https://i.imgur.com/wKSwYzD.png', 'Get little ones excited for their future rides to school with the Little People® Sit with Me School Bus! Get the fun started by pressing the Discovery Button to flip open the stop sign and pop open the door to let on passengers.', 'Get little ones excited for their future rides to school with the Little People® Sit with Me School Bus! Get the fun started by pressing the Discovery Button to flip open the stop sign and pop open the door to let on passengers.Get little ones excited for their future rides to school with the Little People® Sit with Me School Bus! Get the fun started by pressing the Discovery Button to flip open the stop sign and pop open the door to let on passengers.Get little ones excited for their future rid', 0),
( 1, 'Fisher-Price® Twinkle &amp; Cuddle Cloud Soother', 725000, 'https://i.imgur.com/AguJUYK.png', 'The Twinkle &amp; Cuddle Cloud Soother from Fisher-Price is a cuddly friend that helps comfort and soothe your baby as they grow from the crib to a big-kid bed. ', 'The Twinkle &amp; Cuddle Cloud Soother from Fisher-Price is a cuddly friend that helps comfort and soothe your baby as they grow from the crib to a big-kid bed. The cloud easily attaches to most cribs and features the Ready, Settle, Sleep™ playlist of gentle music and soft white noise, which syncs with the multicolor light show to set a soothing scene for sweet dreams. And since every baby is different, you can easily customize the music, soothing nature sounds, volume, and light color to find the combination that works best for your little snoozer! As your baby grows, this snuggly soother becomes a comforting take-along pal.', 2),
( 1, '3-in-1 Sit, Stride &amp; Ride Lion', 1037000, 'https://i.imgur.com/lIHNNbV.png', 'With 3 ways to play that grow with your baby, the Fisher-Price® Sit, Stride &amp; Ride Lion is triple the fun — and so versatile! Each stage takes little ones through important developmental milestones.', 'With 3 ways to play that grow with your baby, the Fisher-Price® Sit, Stride &amp; Ride Lion is triple the fun — and so versatile! Each stage takes little ones through important developmental milestones. Sit &amp; Play. For sitting babies, tons of hands-on activities make this lion a roaring good time! He has a light-up button nose … a mane with 10 light-up buttons that teach numbers &amp; colors … a butterfly flipper … a fun spinner … and balls to “feed” him that come spilling out below! Push &amp; Walk. When your little one is ready to get up and go, lift the seat for a handle to steady first steps while fun phrases &amp; songs encourage them to keep going. “Take a few steps 1, 2, 3!” Scoot &amp; Ride. Taking this sweet lion friend for a ride is easy! Just lower the seat for your toddler to scoot along to more encouraging phrases &amp; songs. “Let’s get moving!”\r\n', 5),
( 1, 'Chatter Telephone®', 120000, 'https://i.imgur.com/lF6AHXp.png', 'With its friendly face, spinning dial, fun ringing-phone sounds, and eyes that move up and down as you pull it along, the Fisher-Price® Chatter Telephone® helps get your baby chatting—and strolling—like a pro!', 'With its friendly face, spinning dial, fun ringing-phone sounds, and eyes that move up and down as you pull it along, the Fisher-Price® Chatter Telephone® helps get your baby chatting—and strolling—like a pro!\r\n\r\nBabies can sit &amp; play or pull it along\r\nChatter Telephone® features fun ringing sounds and eyes that move up &amp; down\r\nDial introduces numbers 0-9\r\nEncourages early role play\r\nFor infants and toddlers ages 12 months and older\r\nSKU #: FGW66\r\n', 0),
( 1, 'Laugh & Learn® Smart Stages™ Learn With Puppy Walker', 576331, 'https://i.imgur.com/g6211zo.png', 'Let''s go for a stroll, baby! Puppy is the perfect pal for your growing baby, offering exciting hands-on activities for little sitters and tons of encouraging phrases and support for those first little steps. As little ones grow and go, Puppy will introduce them to the alphabet, shapes, colors, counting, and even Spanish words!\r\n', 'Let''s go for a stroll, baby! Puppy is the perfect pal for your growing baby, offering exciting hands-on activities for little sitters and tons of encouraging phrases and support for those first little steps. As little ones grow and go, Puppy will introduce them to the alphabet, shapes, colors, counting, and even Spanish words!\r\n\r\nWhere development comes into play™\r\n\r\nAcademics: Playful songs and phrases introduce your baby to the alphabet, colors, numbers, Spanish words, and more!\r\n\r\nGross Motor: Little muscles get a big workout as sitting little ones reach for and interact with the activities and then pull up to stand and walk behind the walker.\r\n\r\nCuriosity & Wonder: As babies discover how to activate the music and phrases by pressing the buttons or pushing the walker along, they see that their actions can make fun things happen—hey, that''s cause & effect!\r\n\r\n', 5),
( 2, 'Cape Cottage Playhouse™ - Pink', 3067081, 'https://i.imgur.com/m90piAg.png', 'The Little Tikes Cape Cottage Playhouse in pink combines style and fun! The modern windows, arched doorway and brick details make this little house the perfect first playhouse for any little girl!  Made in USA.', 'The Little Tikes Cape Cottage Playhouse in pink combines style and fun! The modern windows, arched doorway and brick details make this little house the perfect first playhouse for any little girl!  Made in USA.\r\n\r\nEasy assembly\r\nContemporary styling\r\n2 Working doors\r\n2 Windows with working shutters\r\nMail slot (mail not included)\r\nFlag holder (flags are not included)\r\nAssembly Required', 0),
( 2, 'First Fridge', 1175956, 'https://i.imgur.com/sRj2IQX.png', 'Kids can pretend to cook and prepare food just like their parents with the super realistic Little Tikes First Fridge. This sleek, modern pretend play fridge is packed with interactive features: a working ice dispenser, dual French doors, a separate freezer drawer, and working fridge lights.', 'Kids can pretend to cook and prepare food just like their parents with the super realistic Little Tikes First Fridge. This sleek, modern pretend play fridge is packed with interactive features: a working ''ice'' dispenser, dual French doors, a separate freezer drawer, and working fridge lights. Plus, it makes realistic sounds like crushed ice, water dispensing, beeps, and more to really extend the pretend play for hours. Pretending to prepare food and do other chores helps kids gain a sense of responsibility, an important part of social-emotional learning. \r\n\r\n \r\n\r\nThe First Fridge is easy to set up to its full size and fits all 11 included accessories for easy cleanup too. The compact design: (15.80\"L X 11.50\"W x 23.00\"H) is great for small spaces. Kids can even customize it by displaying their grocery lists or artwork on the door. Encourage kids to engage in imaginative pretend play with the First Fridge by Little Tikes!', 0),
( 2, 'Backyard Bungalow House', 4266331, 'https://i.imgur.com/ZvImb1f.png', 'The Little Tikes Backyard Bungalow Roleplay Playhouse is big enough for all imaginations.', 'The Little Tikes Backyard Bungalow Roleplay Playhouse is big enough for all imaginations. This outdoor playhouse has enough room for multiple kids to play in at the same time and includes a working door and mailbox with a slot that actually opens and closes. Three roleplay stations include: a kitchenette with pretend stove and sink, a lemonade stand with a real chalkboard and a gardening station with make-believe flowers. Over 25 accessories and a canopy that opens and closes means kids 2+ will be able to play for hours. Kids will dream large with the Little Tikes Backyard Bungalow Roleplay Playhouse! Made in USA with US & imported components.', 0),
( 2, 'LOL Surprise™ Winter Disco™ Cottage', 3805081, 'https://i.imgur.com/Guo0GGN.png', 'If your LOL Surprise fan loves imaginative role play, then look no further than the Little Tikes LOL Surprise Winter Disco Playhouse. ', 'If your LOL Surprise fan loves imaginative role play, then look no further than the Little Tikes LOL Surprise Winter Disco Playhouse. Both you and your kids are sure to love this fashionable playhouse with its light-up disco ball, inflatable chair, glittery details, working doors, windows, and shutters.  Kids will love the fun role play elements like a working mail slot and flag holder that will spark their imaginations. It''s easy to assemble and take apart with minimal hassle and tools, and the lightweight design makes it easy to move, transport, or store as well. The Little Tikes LOL Surprise Winter Disco Playhouse can be used indoors or outdoors, there''s no limit to what your kids can imagine as they play.\r\n', 0),
( 2, 'Real Wood Adventures™ Bobcat Ridge™', 39206019, 'https://i.imgur.com/yKzx6a5.png', 'The Real Wood Adventures Bobcat Ridge playset has space and activities for up to 12 kids to play at once.', 'The Real Wood Adventures Bobcat Ridge playset has space and activities for up to 12 kids to play at once. The roomy, comfortable, multi-tiered clubhouse deck has fabric shades and is perfect for campouts, stargazing, and all of kids'' favorite activities.', 2),
( 3, 'Star Wars The Child Plush Toy', 576555, 'https://i.imgur.com/gXuoLXn.png', 'Star Wars The Child Plush Toy, 11-inch Small Yoda-like Soft Figure from The Mandalorian', 'Fully embrace the cuteness of the 50-year-old Yoda species with this adorable 11-inch plush toy. He may look like a Baby Yoda, but this lovable creature is referred to as The Child. Inspired by the Disney+ live-action series The Mandalorian, this sweet Star Wars plush toy makes a Force-sensitive addition to your collection.', 0),
( 3, 'Barbie®DreamHouse™ Dollhouse', 4612000, 'https://i.imgur.com/QD11uTh.png', 'Barbie®DreamHouse™ Dollhouse with Pool, Slide and Elevator, Plus Lights, Sounds and 70+ Total Accessories, for 3 to 7 Year Olds​​​\r\n', 'With so many exciting features and accessories, the Barbie® DreamHouse™ encourages young imaginations to move into this dollhouse and set up a dream home. Kids will have limitless ways to play and explore, from friend sleepovers and family bonding moments to birthday parties and backyard BBQs!\r\n\r\nThe Barbie® DreamHouse™ measures an impressive 3+ feet tall and 4+ feet wide and features 3 stories, 8 rooms and 70+ accessories.\r\nSpecial amenities include a working elevator, home office, carport and second-story pool — fill it with water for a real splash!\r\nLights and sounds add delightful touches, while 2-in-1 transforming furniture pieces expand the storytelling possibilities.\r\nThe plug-and-play design helps keep pieces in place as small hands move around (and makes cleanup easy for adult hands).', 0),
( 3, 'Jurassic World Isla Nublar Escape Set', 329000, 'https://i.imgur.com/hFqacCr.png', 'Relive nostalgic, iconic film moments with the Jurassic World Isla Nublar Escape Set that captures the spirit of the franchise legacy with movie-authentic decoration and deluxe detail!', 'Relive nostalgic, iconic film moments with the Jurassic World Isla Nublar Escape Set that captures the spirit of the franchise legacy with movie-authentic decoration and deluxe detail! Inspired by the original Jurassic Park film, the set includes action figures of pioneering scientist and the father of Jurassic World, John Hammond and everyone''s favorite paleobotanist, Dr. Ellie Sattler (both figures are 6-in/15.24-cm tall). The set also includes two iconic Velociraptors (one in a crouching pose and one is standing) plus a film-inspired banner imprinted with \"When Dinosaurs Ruled the Earth.\" Take home the excitement of Jurassic Park with this collectible Isla Nublar Escape set! Makes a great collectible gift for ages 4 and up especially fans of the Jurassic World franchise, dinosaurs and action play! Colors and decorations may vary.​\r\n\r\n', 0),
( 3, 'Jurassic World Destroy ''N Devour Indominus Rex', 653000, 'https://i.imgur.com/bOCRfNs.png', 'Be a part of the Jurassic World adventure with the ultimate in dinosaur battle action! A hybrid abomination of InGen labs.', 'Be a part of the Jurassic World adventure with the ultimate in dinosaur battle action! A hybrid abomination of InGen labs, Destroy ''N Devour™ Indominus Rex is the most terrifying and deadliest dinosaur ever masterminded by science. Inspired by the film, this larger-size Indominus Rex dinosaur is approximately 8 ½ inches high and 23-inches long—and wreaks havoc and fear—everywhere! Ominous features include ghostly white scales, vicious teeth, and long, dagger-like forearms. Indominus Rex features dual-button movement and sound activation: press the button in the middle of Indominus''s back to activate arm movement and realistic slashing sound effects; and press the button at the base of the tail to trigger jaw chomping and roaring sounds! Best of all, the Indominus Rex can bend down to pick up and swallow 3 ¾ inch human action figures whole!', 30),
( 3, 'Cave Club™ Rockelle™ & Tyrasaurus™ Doll & Figure', 452000, 'https://i.imgur.com/eesUYOb.png', '​Meet the Cave Club™ -- a truly unruly group of prehistoric kids who are way ahead of their time! With Cave Club™', '​Meet the Cave Club™ -- a truly unruly group of prehistoric kids who are way ahead of their time! With Cave Club™ dolls and toys, kids can travel back in time and discover wild new stories with their favorite prehistoric characters, like Rockelle™ and her giant dino bestie, Tyrasaurus™! Ready to stomp into adventure? Seat Rockelle™ doll in the saddle and clip her legs in -- there''s even a second seat for a friend (other dolls sold separately). When it''s time for a pit stop, kids can feed the T-Rex a dino snack -- press the lever on her neck to open and close her mouth and help her chomp on a food piece! Use the hairbrush and clip-in hair accessory to give the Cave Club™ besties rockin'' new looks, then saddle up and hit the trail again. Rockelle™ doll has a wild, neon-bright hairstyle and wears a dress with a fierce animal print. Adventurers aged 4 years old and up can collect more Cave Club™ dolls and toys to make history with the whole crew! Each sold separately, subject to availabili', 0),
( 4, '2-in-1 Step Up™ Potty', 345000, 'https://i.imgur.com/Hgkmqug.png', 'The Summer® 2-in-1 Step Up™ Potty features two solutions in one - a potty seat and stepstool! This potty comes equipped with a removable pot with a pour spout for easy clean up and mess-free potty training. When it’s time to transition to the adult potty, simply close the lid to convert this potty into a stepstool with non-slip rubber feet for your', 'FEATURES AND BENEFITS + –\r\n2-in-1 solution: potty seat and stepstool\r\nPotty seat provides quick, convenient use featuring a removable pot with pour spout making it easy to empty and clean\r\nConverts to a stepstool for use at the adult sink & toilet\r\nNon-slip rubber feet for safety', 0),
( 4, 'Keep Me Clean® Disposable Potty Protectors 20-Pack', 259000, 'https://i.imgur.com/y2YbaRu.png', 'Keep Me Clean® Disposable Potty Protectors provide a convenient hygienic solution for public restrooms. These toss away protectors are extra large to fit any toilet and have adhesive backing to secure it in place.\r\n', 'FEATURES AND BENEFITS + –\r\nSoft, comfortable plastic waterproof material \r\nExtra large to cover front of toilet and areas where kids hold on\r\nStrong adhesive bottom at the center of the cover keeps cover in place\r\nPerfect for travel\r\n20 pieces included', 10),
( 4, 'Affirm™ 335 DLX Rear-Facing Infant Car Seat', 4560000, 'https://i.imgur.com/eLPo86Z.png', 'The Summer® Affirm TM 335 DLX rear facing infant car seat is advanced safety made simple. It is specifically designed to address the foundations of safety, fit-to-child and fit-to-vehicle, while being used correctly every time!', 'The Summer® Affirm TM 335 DLX rear facing infant car seat is advanced safety made simple. It is specifically designed to address the foundations of safety, fit-to-child and fit-to-vehicle, while being used correctly every time! Plus, the uniquely designed base provides the reinforcing strength of steel. One of your first big decisions as a parent is choosing the best car seat for you baby, so we designed this newborn car seat with a number of advanced safety features.\r\n \r\nThe Affirm TM 335 DLX car seat includes an adjustable harness position to provide a perfect fit for babies from 3-35 pounds, with no insert required. Engineered with added levels of SureShieldTM protection, the Affirm TM 335 has been front impact, side impact, rear-impact, rollover, and 2X impact force tested, as well as aircraft approved and conforms to the ASTM 2050 hand-held infant carrier standard. Plus, this Summer car seat offers a low and deep child position with full-surround EPS energy absorbing foam.\r\n', 5),
( 4, 'Banister & Stair, Top of Stairs Gate with Dual Installation Kit', 2300000, 'https://i.imgur.com/Y3E6dj7.png', 'The ultra-versatile Banister & Stair Gate with Dual Installation Kit helps provide parents of mobile toddlers with peace of mind. This sleek gate accommodates banister-to-banister installation, single banister installation at the top or bottom of stairs, as well as installation in doorways and other openings.\r\n', 'FEATURES AND BENEFITS + –\r\nFits doorway openings 32\" to 48\" wide\r\nFits stairs 32’ to 48’ wide when using banister kit\r\nThe banister installation kit accommodates square banisters up to 3.5” wide.\r\n33\" tall\r\nBanister kit included for safe and easy mounting at the top or bottom of stairs\r\nStylish and durable wood design', 2),
( 4, 'Metal Banister & Stair Safety Gate', 2055000, 'https://i.imgur.com/ESK5GlD.png', 'The Summer® Metal Banister & Stair Safety Gate is specifically designed for stairways and banisters. A unique mounting system securely fastens to your banister and eliminates the need to drill into your wood. The extra-wide door opens the full width of your stairway, making it easy to walk through. Plus, the no threshold design minimizes tripping, ', 'FEATURES AND BENEFITS + –\r\nWhite metal safety gate; banister installation kit included\r\nInstall banister-to-banister or banister-to-wall; No drilling required when installing to banister\r\nExtra-wide door opens full width of your stairway; No threshold suspended design of gate door helps to prevent tripping\r\nAdditional features: support foot for added stability; directional door stop for added safety over stairs \r\n32.5” tall, 31” – 46” wide   ', 2),
( 5, 'Hogwarts™ Wizard’s Chess', 1383000, 'https://i.imgur.com/BIUYutF.png', 'LEGO® Harry Potter™ Hogwarts™ Wizard’s Chess (76392) combines an endlessly enjoyable board game with magical role play for fans of the popular movies.', 'LEGO® Harry Potter™ Hogwarts™ Wizard’s Chess (76392) combines an endlessly enjoyable board game with magical role play for fans of the popular movies.\r\n\r\nAuthentic chess set from the wizarding world\r\nThis fascinating chess set provides young witches and wizards with 2 ways to play and stretch their imaginations. It’s an enchanting introduction to the wonderful game of chess, and it’s an authentic recreation of one of the most memorable scenes in Harry Potter and the Sorcerer''s Stone™. Kids are sure to be captivated for hours on end – whether they are enjoying a game of chess or role-playing endless adventures with characters from the magical movies. The set includes Harry Potter, Hermione Granger™ and Ron Weasley™ minifigures to inspire kids’ creative enjoyment. To celebrate 20 years of magic with LEGO Harry Potter, the set also includes an exclusive, golden Professor Severus Snape™ minifigure and 3 random wizard card tiles for kids to collect.\r\n\r\n', 2),
( 5, 'Fawkes, Dumbledore’s Phoenix', 922000, 'https://i.imgur.com/79gHJGU.png', 'LEGO® Harry Potter™ Fawkes, Dumbledore’s Phoenix (76394) is a realistic model of the iconic phoenix from the Harry Potter movies that kids can display – and ‘fly’ – for all their friends to admire.', 'Buildable Fawkes the phoenix with ‘flying’ wings\r\nThis 597-piece, brick-built model recreates the fiery feathers, powerful beak and graceful flight of Fawkes the phoenix. The model is not only rewarding to build and impressive to display – it also features realistically jointed wings that move. Kids simply turn the handle at the rear to make the articulated wings flap gracefully up and down, displaying Fawkes’ full wingspan of over 14 in. (35 cm). The collectible model stands on a sturdy base and is accompanied by an Albus Dumbledore™ LEGO minifigure alongside a smaller Fawkes figure.\r\n\r\n', 2),
( 5, 'Adventures with Luigi Starter Course', 1400000, 'https://i.imgur.com/H18EmL8.png', 'Introduce children to the interactive LEGO® Super Mario™ universe with this Adventures with Luigi Starter Course (71387). An awesome gift toy for trend-setting kids, it features a LEGO® Luigi™ figure that gives instant expressive responses via an LCD screen and speaker. ', 'Introduce children to the interactive LEGO® Super Mario™ universe with this Adventures with Luigi Starter Course (71387). An awesome gift toy for trend-setting kids, it features a LEGO® Luigi™ figure that gives instant expressive responses via an LCD screen and speaker. Players earn digital coins for helping LEGO Luigi complete spinning seesaw and flying challenges, interactions with Pink Yoshi and defeating Boom Boom and a Bone Goomba. The nougat-brown-colored bricks in this Tower biome also trigger different reactions from LEGO Luigi, and the ? Block offers extra rewards.\r\n\r\nCreative fun\r\nFind building instructions in the free LEGO Super Mario app, which also includes inspiration for ways to rebuild levels and more.\r\n\r\nUnlimited possibilities\r\nCollectible LEGO Super Mario toy playsets offer a new way to play, in the real world, with iconic Super Mario characters. The Starter Courses and Expansion Sets, plus Power-Up Packs, combine in limitless ways to allow fans to build their own le', 0),
( 5, 'NASA Space Shuttle Discovery', 4650000, 'https://i.imgur.com/MNIhWfN.png', 'The first American woman to complete a spacewalk in 1984, former NASA Astronaut Kathy Sullivan joined the team on the Space Shuttle Discovery and went on to participate in the mission to deploy the Hubble Space Telescope in 1990. T', ' Today Dr. Sullivan works to help break down barriers here on earth and encourage kids, and especially girls, to consider careers in the science, technology, engineering and mathematics fields.\r\n', 0),
( 5, 'Harry Potter & Hermione Granger™', 2767269, 'https://i.imgur.com/xBgTIDH.png', 'Make a BIG impression on any young witch or wizard with the super-sized LEGO® Harry Potter™: Harry Potter & Hermione Granger™ (76393).', 'Make a BIG impression on any young witch or wizard with the super-sized LEGO® Harry Potter™: Harry Potter & Hermione Granger™ (76393).\r\n\r\nLarge-scale, iconic figures\r\nKids can maximize the magical fun with these brick-built Harry Potter and Hermione Granger models. Both figures stand 10 in. (26 cm) tall and possess all the adjustability of the smaller LEGO minifigures: movable hand, leg and hip joints, plus a rotatable head for the Harry Potter figure. Harry has a removable, fabric robe and both models carry brick-built wands to help inspire magical stories for kids to play out. When the action stops, kids can put the 2 Hogwarts™ friends into a pose to create an amazing ‘Harry and Hermione’ display for their room. Individual sets of building instructions allow 2 builders to share the fun together.', 3);




";
  
  pg_query($conn,$q2);	
			echo "<br>Add data to Table!";
	