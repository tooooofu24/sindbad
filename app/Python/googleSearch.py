from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support import expected_conditions as EC
import sys
import time


try:
    # driverの設定
    s = Service('/Users/kawakamiriko/Downloads/chromedriver')
    options = webdriver.ChromeOptions()
    # options.add_argument("--headless")
    options.add_argument("--window-size=1080x1280")
    driver = webdriver.Chrome(service=s, options=options)

    # 引数を検索ワードに指定
    word = sys.argv[1]

    # 検索情報
    url = "https://www.google.com/search?hl=jp&q=" + \
        word + "&btnG=Google+Search&tbs=0&safe=off&tbm=isch"

    # ページにアクセス
    driver.get(url)

    #  Google検索の最初の画像をクリック
    img_tag = WebDriverWait(driver, 10).until(EC.visibility_of_element_located(
        (By.CSS_SELECTOR, "#islmp img")))
    actions = ActionChains(driver)
    actions.move_to_element(img_tag)
    actions.click(img_tag)
    actions.perform()

    # 2秒待機
    time.sleep(2)

    # 右側に表示されたimgタグを取得
    images = WebDriverWait(driver, 10).until(EC.visibility_of_any_elements_located(
        (By.CSS_SELECTOR, "#islsp img")))

    # httpsで始まるものを取得
    for img in images:
        img_url = img.get_attribute('src')
        width = int(img.get_attribute('width'))
        height = int(img.get_attribute('height'))
        if(img_url.startswith('https')):
            break

    # ブラウザを終了
    driver.quit()

    print(img_url)

except:
    print('error')
