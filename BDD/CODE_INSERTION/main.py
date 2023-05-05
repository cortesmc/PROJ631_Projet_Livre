import mysql.connector
import json


with open('clean_books_infos.json', 'r') as f:
  data = json.load(f)

# print(data[0])


connection_params = {
    'host': "localhost",
    'user': "root",
    'password': "",
    'database': "proj631_livres",
}

conn = mysql.connector.connect(**connection_params)

crx = conn.cursor()



i = 0

for book in data[8:]:

    title = book['title']
    print(title)
    resume = book['summary']
    thumbnail = book['cover_url']
    year = book['year']

    values_book = (title, resume, thumbnail, str(year))
    # -- Insertion du livre

    crx.execute("insert into Book (title, resume, thumbnail, year) \
                 values (%s, %s, %s, %s)",
                values_book )

    res_inutile = crx.fetchone()

    conn.commit()



    # -- Get the id of the book
    idBook = None
    crx.execute("SELECT idBook FROM Book WHERE title = %s", (title,))

    result1 = crx.fetchone()

    print(result1)

    for i, data in enumerate(result1):
        if i == 0:
            idBook = data

    # -- Insertion des genres du livres
    for genre in book['genre']:

        # -- Insert Genre
        crx.execute( "insert into Genre (libele) SELECT %s FROM DUAL WHERE NOT EXISTS (SELECT libele FROM Genre WHERE libele = %s)", (genre, genre) )
        res_inutile = crx.fetchone()
        conn.commit()

        # -- get id genre inserted
        idGenre = None
        crx.execute("SELECT idGenre FROM Genre WHERE libele = %s", (genre,))
        result2 = crx.fetchone()

        for i, data in enumerate(result2):
            if i == 0:
                idGenre = data

        # -- Insert in Belong the ids of tables
        crx.execute("insert into Belong (idBook, idGenre) values (%s, %s)", (idBook, idGenre))
        res_inutile = crx.fetchone()
        conn.commit()

    # -- Insertion des authors du livres
    for author in book['author']:
        # -- Insetr Author
        crx.execute("insert into Author (name) SELECT %s FROM DUAL WHERE NOT EXISTS (SELECT name FROM Author WHERE name = %s)", (author, author))
        res_inutile = crx.fetchone()
        conn.commit()

        # -- get id genre inserted
        idAuthor = None
        crx.execute("SELECT idAuthor FROM Author WHERE name = %s", (author,))
        result2 = crx.fetchone()

        for i, data in enumerate(result2):
            if i == 0:
                idAuthor = data




        # -- Insert in Belong the ids of tables
        crx.execute("insert into IsWrite (idAuthor, idBook) values (%s, %s)", (idAuthor, idBook))
        res_inutile = crx.fetchone()
        conn.commit()



    print(i)






    if i >= 74:
        break



    i += 1






crx.close()
conn.close()