import mysql.connector
import json

with open('clean_books_infos.json', 'r') as f:
    data = json.load(f)

connection_params = {
    'host': "localhost",
    'user': "root",
    'password': "",
    'database': "proj631_livres",
}

conn = mysql.connector.connect(**connection_params)

crx = conn.cursor()

i = 0

for book in data:
    title = book['title']
    resume = book['summary']
    thumbnail = book['cover_url']
    year = book['year']

    values_book = (title, resume, thumbnail, str(year))

    # Inserting book
    crx.execute("insert into Book (title, resume, thumbnail, year) \
                 values (%s, %s, %s, %s)", values_book)
    conn.commit()

    # collect book id's
    idBook = None
    crx.execute("SELECT idBook FROM Book WHERE title = %s", (title,))
    result1 = crx.fetchall()
    if result1:
        idBook = result1[0][0]

    # Inserting genres of book
    for genre in book['genre']:
        # Insertion du genre
        crx.execute("insert into Genre (libele) SELECT %s FROM DUAL WHERE NOT EXISTS (SELECT libele FROM Genre WHERE libele = %s)", (genre, genre))
        conn.commit()

        # collect genre id's
        idGenre = None
        crx.execute("SELECT idGenre FROM Genre WHERE libele = %s", (genre,))
        result2 = crx.fetchall()
        if result2:
            idGenre = result2[0][0]

        
        #Check if ids already exist if not its add it 
        # Inserting ids in Belong
        crx.execute("insert ignore into Belong (idBook, idGenre) values (%s, %s)", (idBook, idGenre))
        conn.commit()

    # Inserting authors
    for author in book['author']:
        # Insertion de l'auteur
        crx.execute("insert into Author (name) SELECT %s FROM DUAL WHERE NOT EXISTS (SELECT name FROM Author WHERE name = %s)", (author, author))
        conn.commit()

        # collect author id's
        idAuthor = None
        crx.execute("SELECT idAuthor FROM Author WHERE name = %s", (author,))
        result3 = crx.fetchall()
        if result3:
            idAuthor = result3[0][0]

        # Inserting ids in IsWrite 
        crx.execute("insert ignore into IsWrite (idAuthor, idBook) values (%s, %s)", (idAuthor, idBook))
        conn.commit()

    print(i)

    # if i >= 74:
    #     break

    i += 1

crx.close()
conn.close()
