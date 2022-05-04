# coding: UTF-8

from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support import expected_conditions as EC
import sys
import time
import platform
import urllib.parse

try:
    # lambdaで起動したときの処理
    if platform.system() == "Linux":
        s = Service("/usr/local/bin/chromedriver")
        # ブラウザ(Chrome)の設定
        options = webdriver.ChromeOptions()
        options.add_argument("--headless")
        options.add_argument("--window-size=1080x1280")
        options.add_argument("--disable-gpu")
        options.add_argument("--disable-application-cache")
        options.add_argument("--disable-infobars")
        options.add_argument("--no-sandbox")
        options.add_argument("--hide-scrollbars")
        options.add_argument("--enable-logging")
        options.add_argument("--log-level=0")
        options.add_argument("--single-process")
        options.add_argument("--ignore-certificate-errors")
        options.add_argument("--homedir=/tmp")
        options.add_argument(
            "--user-agent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15"
        )
        driver = webdriver.Chrome(service=s, options=options)
    else:
        # ローカルで起動したときの処理
        s = Service("/Users/kawakamiriko/Downloads/chromedriver")
        options = webdriver.ChromeOptions()
        # options.add_argument("--headless")
        options.add_argument("--window-size=1080x1280")
        driver = webdriver.Chrome(service=s, options=options)

    # 引数を検索ワードに指定
    q = sys.argv[1]

    url = "https://www.google.com/search?"

    # 検索パラメータ
    query = urllib.parse.urlencode(
        {
            "tbm": "isch",  # 画像検索
            "q": q,  # 検索文字列
            "hl": "ja",  # 言語
            "tbs": "il:cl",  # クリエイティブ・コモンズ・ライセンス
        }
    )

    # 検索
    driver.get(url + query)

    #  Google検索の最初の画像をクリック
    try:
        img_tags = WebDriverWait(driver, 5).until(
            EC.visibility_of_any_elements_located(
                (By.CSS_SELECTOR, "#islmp img"))
        )
    except:
        print("")
        driver.quit()
        sys.exit()

    img_url = ""
    for img_tag in img_tags:
        actions = ActionChains(driver)
        actions.move_to_element(img_tag)
        actions.click(img_tag)
        actions.perform()

        # 2秒待機
        time.sleep(2)

        # 右側に表示されたimgタグを取得
        img = WebDriverWait(driver, 10).until(
            EC.visibility_of_element_located(
                (By.CSS_SELECTOR, "#Sva75c > div > div > div.pxAole > div.tvh9oe.BIB1wf > c-wiz > div > div.OUZ5W > div.zjoqD > div.qdnLaf.isv-id > div > a > img"))
        )

        # httpsで始まるものを取得
        img_url = img.get_attribute("src")

        # favicon以外のhttpsから始まる画像urlを取得
        if img_url.startswith('https'):
            break
        else:
            img_url = ""

    # ブラウザを終了
    driver.quit()

    print(img_url)

except Exception as e:
    print("")
    if "driver" in locals():
        driver.quit()
