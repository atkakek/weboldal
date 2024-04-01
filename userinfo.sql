
CREATE TABLE `likedmovies` (
  `id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `movieId` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `overview` varchar(2000) DEFAULT NULL,
  `poster_path` varchar(100) DEFAULT NULL,
  `backdrop_path` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `likedmovies`
--

INSERT INTO `likedmovies` (`id`, `userName`, `movieId`, `title`, `overview`, `poster_path`, `backdrop_path`) VALUES
(1, 'test', 1089979, 'Just One Small Favor', 'The Gallardos are a rich, well-respected family, who spend their summers in a beautiful country house, which is taken meticulous care of by Amparito. Dearly loved by the familys three children, Teresa, Benja and Aura, Amparito, known to them as Nanny, has been like a second mother to them. When they receive the sad news of her death, the three siblings travel to the village to say their last goodbyes and see Tomás, the deceaseds only son. What they werent expecting is that Amparitos dying wish was to be buried in the family cemetery. The Gallardos are clear: theres no way! After refusing to do this favor, they receive an inheritance from Amparito... Some letters in which, far from giving them a sweet goodbye, she gets even, revealing skeletons in closets and hurtful truths that will turn their lives upside down. What the hell was Nanny thinking?', NULL, NULL),
(2, 'test', 798141, 'Doors', 'Without warning, millions of mysterious alien “doors” suddenly appear around the globe. In a rush to determine the reason for their arrival, mankind must work together to understand the purpose of these cosmic anomalies.', NULL, NULL),
(3, 'test', 559, 'Spider-Man 3', 'The seemingly invincible Spider-Man goes up against an all-new crop of villains—including the shape-shifting Sandman. While Spider-Mans superpowers are altered by an alien organism, his alter ego, Peter Parker, deals with nemesis Eddie Brock and also gets caught up in a love triangle.', NULL, NULL),
(4, 'test', 939335, 'Muzzle', 'LAPD K-9 officer Jake Rosser has just witnessed the shocking murder of his dedicated partner by a mysterious assailant. As he investigates the shooters identity, he uncovers a vast conspiracy that has a chokehold on the city in this thrilling journey through the tangled streets of Los Angeles and the corrupt bureaucracy of the LAPD.', NULL, NULL),
(5, 'atka', 508943, 'Luca', 'Luca and his best friend Alberto experience an unforgettable summer on the Italian Riviera. But all the fun is threatened by a deeply-held secret: they are sea monsters from another world just below the waters surface.', 'https://image.tmdb.org/t/p/w300/9x4i9uKGXt8IiiIF5Ey0DIoY738.jpg', NULL),
(6, 'atka', 294254, 'Maze Runner: The Scorch Trials', 'Thomas and his fellow Gladers face their greatest challenge yet: searching for clues about the mysterious and powerful organization known as WCKD. Their journey takes them to the Scorch, a desolate landscape filled with unimaginable obstacles. Teaming up with resistance fighters, the Gladers take on WCKDs vastly superior forces and uncover its shocking plans for them all.', 'https://image.tmdb.org/t/p/w300/k9kPcaC5Tp35ZT1osl6AqqsvzBk.jpg', NULL),
(7, 'atka', 335988, 'Transformers: The Last Knight', 'Autobots and Decepticons are at war, with humans on the sidelines. Optimus Prime is gone. The key to saving our future lies buried in the secrets of the past, in the hidden history of Transformers on Earth.', 'https://image.tmdb.org/t/p/w300/s5HQf2Gb3lIO2cRcFwNL9sn1o1o.jpg', NULL),
(8, 'atka', 632856, 'Spirited', 'Each Christmas Eve, the Ghost of Christmas Present selects one dark soul to be reformed by a visit from three spirits. But this season, he picked the wrong Scrooge. Clint Briggs turns the tables on his ghostly host until Present finds himself reexamining his own past, present and future.', 'https://image.tmdb.org/t/p/w300/h3zAzTMs5EP3cKusOxFNGSFE1WI.jpg', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `pw` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`userId`, `userName`, `pw`) VALUES
(16, 'test', '$2y$10$6bDshW2AKXX3PUMI4xT7gO.A8sgsFn9xmLZki2fBa.DD9kDMdI3fC'),
(17, 'atka', '$2y$10$iO5XeS4XS26SnA84StDrWeivJ6g0glEEnf12iaBE6Em30pWwkPyO.'),
(18, 'atka2', '$2y$10$G5Y6QHfPOL/ukiWCWmwk3Oo/wXYoDf9wy76nMWHNLqK6swMt7Ly0m'),
(19, 'test2', '$2y$10$iYiLgyHHjgEKZaClVYy7SOZ./t0GfbwFx67A3nv0fgTWV88h0sQxG');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `likedmovies`
--
ALTER TABLE `likedmovies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userName` (`userName`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName_2` (`userName`),
  ADD KEY `userName` (`userName`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `likedmovies`
--
ALTER TABLE `likedmovies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `likedmovies`
--
ALTER TABLE `likedmovies`
  ADD CONSTRAINT `likedmovies_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `users` (`userName`);
COMMIT;


