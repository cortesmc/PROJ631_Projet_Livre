import requests
import json

#This fonction take a liste of all genre and compare it to most famous genre 
#It return only the most important genres present in the book
def clean_genre(liste_genre):
    dict_genre = {"Thriller":False,"Drama":False,"Fantasy":False,"Autobiography":False,
                  "Action":False,"Adventure":False,"Biography":False,"Children":False
                  ,"Comic book":False,"Fairytale":False,"Historical":False,"Horror":False
                  ,"Mystery":False,"Poetry":False,"Romance":False,"Encyclopedia":False
                  ,"Humor":False,"Journal":False,"Science":False}
    for genre in liste_genre:
        if "thriller" in genre:
            dict_genre["Thriller"] = True
        elif "drama" in genre:
            dict_genre["Drama"] = True
        elif "fantasy" in genre:
            dict_genre["Fantasy"] = True    
        elif "autobiography" in genre:
            dict_genre["Autobiography"] = True
        elif "action" in genre:
            dict_genre["Action"] = True    
        elif "adventure" in genre:
            dict_genre["Adventure"] = True
        elif "biography" in genre:
            dict_genre["Biography"] = True
        elif "children" in genre:
            dict_genre["Children"] = True    
        elif "comic book" in genre or "comic" in genre:
            dict_genre["Comic book"] = True
        elif "fairytale" in genre:
            dict_genre["Fairytale"] = True
        elif "historical" in genre:
            dict_genre["Historical"] = True    
        elif "horror" in genre:
            dict_genre["Horror"] = True
        elif "mystery" in genre:
            dict_genre["Mystery"] = True    
        elif "poetry" in genre:
            dict_genre["Poetry"] = True
        elif "romance" in genre:
            dict_genre["Romance"] = True
        elif "encyclopedia" in genre:
            dict_genre["Encyclopedia"] = True    
        elif "humor" in genre or "fun" in genre:
            dict_genre["Humor"] = True
        elif "journal" in genre:
            dict_genre["Journal"] = True    
        elif "science" in genre:
            dict_genre["Science"] = True
    ans = []
    for new_genre_value,new_genre_key in zip(dict_genre.values(),dict_genre.keys()):
        if new_genre_value == True:
            ans.append(new_genre_key)
            
    return ans
            
def clean_title(title):
    new_title =  title.replace("'"," ")
    last_title = new_title.replace('"',"")
    return last_title
#This function find information about one book with its title
def search_book_by_title(title):
    response = requests.get(f"https://openlibrary.org/search.json?q={title}&limit=1")

    if response.status_code == 200:
        
        data = response.json()
        if (len(data["docs"])!=0):
            book_data = data["docs"][0]
            title = book_data.get("title", "N/A")
            author = book_data.get("author_name", ["N/A"])
            year = book_data.get("first_publish_year", "N/A")
            summary = book_data.get("description", {}).get("value", "N/A")
            genre = clean_genre(book_data.get("subject", ["N/A"])) 
            cover_id = book_data.get("cover_i", None)
            cover_url = f"https://covers.openlibrary.org/b/id/{cover_id}-L.jpg" if cover_id else None
            book_info = {
                "title": title,
                "author": author,
                "year": year,
                "summary": summary,
                "genre": genre,
                "cover_url": cover_url
            }
            return book_info
    else:
        print("Error while searching books")
        return None


#We use the json file with all book to use the API Open Library
#As there are a lot of books we started the fonction at the n books
def all_books(n):
    
    with open("books.json",'r') as f:
        books_data= json.load(f)
        
    with open("books_infos.json","r") as f2:
        save = json.load(f2)
    if len(save) == 0:
        res = []
    else:
        res = save
    books_data = books_data[n:]
    for book,i in zip(books_data,range(0,len(books_data))):
        cpt = len(save) +i

        print(f"C'est le {cpt}ème livre ajouté")
        
        title_book = book["title"]
        print(title_book)
        infos = search_book_by_title(title_book)
        if infos == None:
            print("OUI C'est None")
        else:
            
            res.append(infos)        
            with open("books_infos.json","w") as f1:
                json.dump(res,f1,indent=3)


def clean_books(filename):
    data = []
    with open(filename,'r')as f:
        data = json.load(f)
        
    print(len(data))
    new_data = []
    for i in range(0,len(data)-1):
        if data[i] is None:
            print("null data")
        else:
            
            if (len(data[i]["genre"])!=0):
                new_data.append(data[i])                
        print(len(new_data))
    with open("clean_books_infos.json",'w') as f3:
        json.dump(new_data,f3, indent= 3)
            
if __name__ == "__main__":
    #search_book_by_title("Le petit prince")
    #var = 7272
    #all_books(5952)
    clean_books("books_infos.json")


